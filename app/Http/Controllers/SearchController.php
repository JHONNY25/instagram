<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Followers;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public $user;
    public $follow;

    public function __construct(User $user,Followers $follow){
        $this->user = $user;
        $this->follow = $follow;
    }

    public function search($nick_name){
        return $this->user->select('id','nick_name','name','profile_photo_path')->where('nick_name','like','%'.$nick_name.'%')->get();
    }

    public function searchUsersIFollow($search){
        return $this->user->select('id','nick_name','name','profile_photo_path')
            ->whereHas('followers',function(Builder $query){
                $query->where('follower_id',auth()->user()->id);
            })
            ->where('nick_name','like','%'.$search.'%')
            ->get();
    }
}
