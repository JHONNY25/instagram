<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public $post;
    public $like;
    public $comment;

    public function __construct(Posts $post,Likes $like,Comments $comment){
        $this->post = $post;
        $this->like = $like;
        $this->comment = $comment;
    }

    public function all(){
        return $this->post->getPosts();
    }

    public function create(Request $request){
        try {
            DB::beginTransaction();

            if(!Auth::check()){
                return redirect()->route('login');
            }

            $post = $this->post->createPost($request);

            DB::commit();

            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(),500);
        }

    }

    public function like(Request $request){

        try {
            if(!$this->like->where('post_id',(int)$request->postId)->where('user_id',auth()->user()->id)->exists()){
                $this->like->createLike((int)$request->postId,(int)auth()->user()->id);

                return response()->json(['like' => true,'likes' => $this->like->where('post_id',$request->postId)->get()],200);
            }else{
                $this->like->deleteLike((int)$request->postId,(int)auth()->user()->id);
                
                return response()->json(['like' => false,'likes' => $this->like->where('post_id',$request->postId)->get()],200);
            }

        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }

    public function comment(Request $request){

        try {
            $comment = $this->comment->postComment($request->all());

            return $this->comment->with('user')->where('id',$comment->id)->first();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }

}
