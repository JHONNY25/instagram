<?php

namespace App\Models;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'description',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Likes::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

    public static function createPost(Request $request){
        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        if(!Storage::disk('public')->exists($name)){
            Storage::disk('public')->put($name, $file);
        }

        return (new static)::create([
            'image_path' => $name,
            'description' => $request->textpost,
            'user_id' => Auth::id(),
        ]);
    }

    public static function getPosts(){
        return (new static)::with([
            'user',
            'likes',
            'comments'
        ])->get();
    }
}
