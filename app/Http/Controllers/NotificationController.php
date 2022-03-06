<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $someNotifications = auth()->user()->notifications->sortByDesc('created_at')->take(4);
        $items = array_values($someNotifications->toArray());

        return response()->json(['someNotifications'=>$items]);
    }
}
