<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public $chat;
    public $user;
    public $usercurrent;

    public function __construct(User $user, Chat $chat){
        $this->chat = $chat;
        $this->user = $user;
        $this->usercurrent = Auth::id();
    }

    public function index(){
        return Inertia::render('Chat/index',[
            'chats' => $this->chat->with([
                'userrecive:id,name,profile_photo_path',
                'usersent:id,name,profile_photo_path',
                'messages' => function($query){
                    $query->latest();
                }
                ])->where('user_sent',$this->usercurrent)
                ->orWhere('user_recive',$this->usercurrent)->get()
        ]);
    }

    public function getChat($nick_name){
        if($this->user->where('nick_name',$nick_name)->exists()){
            $user = $this->user->where('nick_name',$nick_name)->first();

            return $this->chat->with([
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
