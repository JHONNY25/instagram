<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index($nick_name){
        $user = $this->user->where('nick_name',$nick_name)->first();

        return Inertia::render('UserProfile/Index', [
            'user' => $user,
        ]);
    }
}
