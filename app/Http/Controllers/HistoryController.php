<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HistoryController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = User::find(auth()->id());
        $videos = $user->videoInHistory()->get();
        $title = 'سجل المشاهدة';
        return view('history.history-index', compact('videos', 'title'));
    }
}
