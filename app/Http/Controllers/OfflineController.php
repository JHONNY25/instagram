<?php

namespace App\Http\Controllers;

use App\Events\OfflineEvent;
use App\Models\User;

class OfflineController extends Controller
{
    protected $model;

    public function __construct(User $user){
        $this->model = $user;
    }

    public function __invoke($userid){
        try {

            $user = $this->model->where('id',$userid)
                ->update([
                    'status' => 0
                ]);
            
            event(new OfflineEvent($this->model->find($userid)));
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }
}
