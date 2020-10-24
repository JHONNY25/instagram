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

    protected $appends = ['countcomments','countlikes'];

    public function getCountCommentsAttribute(){
        return $this->comments->count();
    }

    public function getCountLikesAttribute(){
        return $this->likes->count();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Likes::class,'post_id');
    }

    public function comments(){
        return $this->hasMany(Comments::class,'post_id');
    }

    public static function createPost(Request $request){
        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        if(!Storage::disk('public')->exists($name)){
            Storage::disk('public')->put($name, $file);
        }

        $post = (new static)::create([
            'image_path' => $name,
            'description' => $request->textpost,
            'user_id' => Auth::id(),
        ]);

        return (new static)::with([
            'user',
            'likes',
            'comments'
        ])->find($post->id);
    }

    public static function getPosts(){
        return (new static)::with([
            'user',
            'likes',
            'comments'
        ])->get();
    }
}
