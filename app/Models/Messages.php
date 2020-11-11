<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Messages extends Model
{
    use HasFactory;
    protected $fillable = [
        'chat_id',
        'user_id',
        'text',
        'image_path',
        'file_path',
        'send_date',
    ];

    public function chat(){
        return $this->belongsTo(Chat::class,'chat_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function sendMessage(Request $request){
        return (new static)::create([
            'chat_id' => $request->chat_id,
            'user_id' => $request->user_id,
            'text' => $request->message,
            'send_date' => Carbon::now()
        ]);
    }
}
