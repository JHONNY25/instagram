<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationsController extends Controller
{
     public function getUnreadNotification(){
         return auth()->user()->unreadNotifications;
     }

}
