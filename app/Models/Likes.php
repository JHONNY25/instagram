<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'post_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function posts(){
        return $this->belongsTo(Posts::class,'post_id');
    }

    public static function createLike(int $postId, int $userId){
        return (new static)::create([
            'like' => 1,
            'post_id' => $postId,
            'user_id' => $userId,
        ]);
    }

    public static function deleteLike(int $postId, int $userId){
        (new static)::where('post_id',$postId)->where('user_id',$userId)->delete();
    }
}
