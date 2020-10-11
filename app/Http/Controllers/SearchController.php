<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function search($nick_name){
        return $this->user->select('id','nick_name','name','profile_photo_path')->where('nick_name',$nick_name)->get();
    }
}
