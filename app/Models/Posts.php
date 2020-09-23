<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'description',
        'user_id',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function likes(){
        $this->hasMany(Likes::class);
    }
}
