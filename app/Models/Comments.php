<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_comment_id',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_comment_id');
    }

    public function post(){
        return $this->belongsTo(Posts::class,'post_id');
    }

    public function postComment(Request $request){
        return (new static)::create([
            'post_id' => $request->post_id,
            'user_comment_id' => $request->user_id,
            'comment' => $request->comment
        ]);
    }
}
