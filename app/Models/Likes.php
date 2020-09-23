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
        $this->belongsTo(User::class);
    }

    public function posts(){
        $this->belongsTo(Posts::class);
    }
}
