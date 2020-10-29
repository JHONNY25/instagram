<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index(){
        return Inertia::render('Chat/index');
    }

    public function getChat($nick_name){
        if(User::where('nick_name',$nick_name)->exists()){
            $user = User::where('nick_name',$nick_name)->first();
    
            return Chat::with([
                'userrecive:id,name,profile_photo_path',
                'usersent:id,name,profile_photo_path',
                'messages'
            ])->where('user_recive',$user->id)
            ->orWhere('user_sent',$user->id)
            ->first();
        }else{
            return response()->json(['error' => 'No se encontro el usuario']);
        }
    }
}
