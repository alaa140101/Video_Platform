<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $someNotifications = auth()->user()->notifications->sortByDesc('created_at')->take(4);
        $items = array_values($someNotifications->toArray());

        $alert = Alert::where('user_id', auth()->user()->id)->first();
        $alert->alert = 0;
        $alert->save();

        return response()->json(['someNotifications'=>$items]);
    }
}
