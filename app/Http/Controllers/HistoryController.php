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

    public function destroy($id){
        auth()->user()->videoInHistory()->wherePivot('id', $id)->detach();

        return back()->with('success', 'تم حذف المقطع من سجلات المشاهدة');
    }

    public function destroyAll(){
        auth()->user()->videoInHistory()->detach();

        return redirect()->back()->with('success', 'تم حذف سجل المشاهدة');
    }
}
