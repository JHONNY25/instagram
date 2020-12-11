<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Models\Chat;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public $chat;
    public $user;
    public $message;

    public function __construct(User $user, Chat $chat,Messages $message){
        $this->chat = $chat;
        $this->user = $user;
        $this->message = $message;
    }

    public function index(){
        return Inertia::render('Chat/Index',[
            'chats' => $this->chat->with([
                'userrecive:id,name,nick_name,profile_photo_path',
                'usersent:id,name,nick_name,profile_photo_path',
                'messages' => function($query){
                    $query->latest();
                }
                ])->where('user_sent',Auth::id())
                ->orWhere('user_recive',Auth::id())->get()
        ]);
    }

    public function getChat($id){

        return $this->chat->with([
                    'userrecive:id,name,nick_name,profile_photo_path,status',
                    'usersent:id,name,nick_name,profile_photo_path,status',
                    'messages'
                ])->where('id',$id)
                ->first();
    }
    
    public function getNewChat($id){

        $chat = $this->chat->create([
            'user_recive' => $id,
            'user_sent' => auth()->user()->id,
        ]);

        return $this->getChat($chat->id);
    }

    public function sendMessage(Request $request){
        try{
            
            $message = $this->message->sendMessage($request);

            event(new SendMessageEvent($message));

        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }
}
