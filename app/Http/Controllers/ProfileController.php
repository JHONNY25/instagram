<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Followers;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public $user;
    public $followers;

    public function __construct(User $user,Followers $followers){
        $this->user = $user;
        $this->followers = $followers;
    }

    public function index($nick_name){
        $user = $this->user->with([
            'posts:id,image_path'
        ])->where('nick_name',$nick_name)->first();

        $followers = $user->followers()->count();
        $followed = $this->followers->where('follower_id',$user->id)->count();
        $posts = $user->posts()->count();

        return Inertia::render('UserProfile/Index', [
            'user' => $user,
            'followers' => $followers,
            'followed' => $followed,
            'posts' => $posts,
        ]);
    }

    public function followUser(Request $request){
        try {
            return $this->followers->follow((int)$request->user_id);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }

    public function unFollowUser(Request $request){
        try {
            $follow = $this->followers->where('user_id',$request->user_id)->where('follower_id',auth()->user()->id)->first();

            return $follow->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }

    public function existsFollow($userId){
        try {
            return $this->followers->where('user_id',$userId)->where('follower_id',auth()->user()->id)->exists()
            ? ['exists' => true] : ['exists' => false];
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }
}
