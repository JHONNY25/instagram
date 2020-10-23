<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $post;

    public function __construct(Posts $post){
        $this->post = $post;
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

            $this->post->createPost($request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(),500);
        }

    }
}
