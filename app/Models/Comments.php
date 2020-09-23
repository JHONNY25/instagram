<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_comment_id',
        'comment',
    ];

    public function user(){
        $this->belongsTo(User::class,'user_comment_id');
    }
}
