<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\User;
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
        if(!$this->user->where('nick_name',$nick_name)->exists()){
            return Inertia::render('404');
        }

        $user = $this->user->with([
            'posts' => function($query){
                $query->orderBy('created_at', 'desc');
            }
        ])->where('nick_name',$nick_name)->first();

        $followers = $user->followers()->count();
        $followed = $this->followers->where('follower_id',$user->id)->count();
        $postsCount = $user->posts()->count();

        return Inertia::render('UserProfile/Index', [
            'user' => $user,
            'followers' => $followers,
            'followed' => $followed,
            'postsCount' => $postsCount
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
