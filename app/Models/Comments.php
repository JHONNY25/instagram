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

    public function postComment($request){
        return (new static)::create($request);
    }
}
