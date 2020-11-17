<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OfflineController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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
    Route::get('/users-search/{nick_name}', [SearchController::class,'search'])->name('users-search');
    Route::post('/create-post', [PostController::class,'create'])->name('create-post');
    Route::get('/get-posts', [PostController::class,'all'])->name('get-posts');

    Route::get('/user-chats', [ChatController::class,'index'])->name('get-chats');
    Route::get('/user-chats/{nick_name}', [ChatController::class,'getChat'])->name('get-chat-user');

    Route::post('/chat/send-message', [ChatController::class,'sendMessage'])->name('create-message');

    Route::post('/user/{userid}/online', OnlineController::class)->name('user-online');
    Route::post('/user/{userid}/offline', OfflineController::class)->name('user-offline');
});
