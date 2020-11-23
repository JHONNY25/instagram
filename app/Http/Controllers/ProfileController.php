<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Followers;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index($nick_name){
        $user = $this->user->with([
            'posts:id,image_path'
        ])->where('nick_name',$nick_name)->first();

        $followers = $user->followers()->count();
        $followed = Followers::where('follower_id',$user->id)->count();
        $posts = $user->posts()->count();

        return Inertia::render('UserProfile/Index', [
            'user' => $user,
            'followers' => $followers,
            'followed' => $followed,
            'posts' => $posts,
        ]);
    }
}
