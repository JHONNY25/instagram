<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OfflineController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotificationsController;
use App\Models\Chat;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function(){
        return Inertia\Inertia::render('Dashboard');
    });

    Route::get('/profile/{nick_name}', [ProfileController::class,'index'])->name('nick_name');
    Route::post('/follow-user', [ProfileController::class,'followUser'])->name('follow-user');
    Route::post('/unfollow-user', [ProfileController::class,'unFollowUser'])->name('unfollow-user');
    Route::get('/exists-follow/{user_id}', [ProfileController::class,'existsFollow'])->where('id', '[0-9]+')->name('exists-follow');

    Route::get('/users-search/{nick_name}', [SearchController::class,'search'])->name('users-search');
    Route::get('/users/chat/{search}', [SearchController::class,'searchUsersIFollow'])->name('users-search-chat');

    Route::post('/create-post', [PostController::class,'create'])->name('create-post');
    Route::get('/get-posts', [PostController::class,'all'])->name('get-posts');
    Route::post('/like-post', [PostController::class,'like'])->name('like-posts');
    Route::post('/post-comment', [PostController::class,'comment'])->name('post-comment');

    Route::get('/user-chats', [ChatController::class,'index'])->name('get-chats');
    Route::get('/user-chats/{id}', [ChatController::class,'getChat'])->name('get-chat-user');
    Route::get('/new-chat/{id}', [ChatController::class,'getNewChat'])->name('get-chat-new-user');
    Route::get('/direct/inbox/{id}', [ChatController::class,'directInbox'])->where('id', '[0-9]+')->name('direct-Inbox');
    Route::post('/chat/send-message', [ChatController::class,'sendMessage'])->name('create-message');
    Route::post('/send-image', [ChatController::class,'sendImage'])->name('send-image');
    Route::post('/send-file', [ChatController::class,'sendFile'])->name('send-file');

    Route::post('/user/{userid}/online', OnlineController::class)->name('user-online');
    Route::post('/user/{userid}/offline', OfflineController::class)->name('user-offline');

    Route::get('/notifications', [NotificationsController::class,'getUnreadNotification'])->name('notifications');
    Route::post('/mark-as-read-notifications', [NotificationsController::class,'markAsRead'])->name('markAsReadNotifications');
});
