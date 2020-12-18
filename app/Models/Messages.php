<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Messages extends Model
{
    use HasFactory;
    protected $fillable = [
        'chat_id',
        'user_id',
        'text',
        'file_path',
        'type',
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

    public static function returnUrlFile(Request $request){
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $url = null;

        $storage = Storage::disk('public')->put($name, $file);
        return asset('storage/'.$storage);
    }

    public static function sendImage(Request $request){
        return (new static)::create([
            'chat_id' => $request->chat_id,
            'user_id' => $request->user_id,
            'file_path' => self::returnUrlFile($request),
            'type' => 'image',
            'send_date' => Carbon::now()
        ]);
    }
}
