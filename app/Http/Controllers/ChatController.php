<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Http\Requests\ImageFileRequest;
use App\Models\Chat;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

    public function directInbox($id){
        $chatQuery = null;
        $chat = null;

        if(!$this->user->where('id',$id)->exists()){
            return Inertia::render('404');
        }

        if(!$this->chat->where('user_sent',Auth::id())->where('user_recive',$id)->exists()){
            if($this->chat->where('user_sent',$id)->where('user_recive',Auth::id())->exists()){
                $chatQuery = $this->chat->select('id')->where('user_sent',$id)->where('user_recive',Auth::id())->first();
                $chat = $this->getChat($chatQuery->id);
            }else{
                $chat = $this->getNewChat($id);
            }
        }else{
            $chatQuery = $this->chat->select('id')->where('user_sent',Auth::id())->where('user_recive',$id)->first();
            $chat = $this->getChat($chatQuery->id);
        }

        return Inertia::render('Chat/DirectInbox',[
            'chat' => $chat
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

        $chat = $this->chat->createChat($id);

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

    public function sendImage(ImageFileRequest $request){
        try{

            $message = $this->message->sendFile($request);

            event(new SendMessageEvent($message));

        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }

    public function sendFile(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:pdf,doc,docx,txt|max:5000',
            ],[
                'required' => 'La imagen es requerida',
                'mimes' => 'Debe de ser un documento tipo .pdf, .doc, .docx, .txt',
                'max' => 'La archivo no debe exceder los 5MB',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $message = $this->message->sendFile($request);

            event(new SendMessageEvent($message));

        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }
}
