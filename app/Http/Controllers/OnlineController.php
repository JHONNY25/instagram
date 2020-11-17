<?php

namespace App\Http\Controllers;

use App\Events\OnlineEvent;
use App\Models\User;

class OnlineController extends Controller
{
    protected $model;

    public function __construct(User $user){
        $this->model = $user;
    }

    public function __invoke($userid){
        try {

            $user = $this->model->where('id',$userid)
                ->update([
                    'status' => 1
                ]);

            event(new OnlineEvent($this->model->find($userid)));
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }
}
