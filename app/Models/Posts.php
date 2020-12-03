<?php

namespace App\Models;

use App\Models\Comments;
use Carbon\Carbon;
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
        'date_posts',
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
        $url = null;

        if(!Storage::disk('public')->exists($name)){
            Storage::disk('public')->put($name, $file);
            $url = Storage::url($name);
        }

        $url = Storage::url($name);

        $post = (new static)::create([
            'image_path' => $url,
            'description' => $request->textpost,
            'user_id' => Auth::id(),
            'date_posts' => Carbon::now(),
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
            'comments' => function($query){
                $query->with('user:id,name,nick_name,profile_photo_path');
            }
        ])->orderBy('created_at', 'desc')->get();
    }
}
