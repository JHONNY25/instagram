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
}
