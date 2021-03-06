<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChannelController extends Controller
{
    public function index() {
        $channels = User::all()->sortByDesc('created_at');
        $title = 'أحدث القنوات' ;
        return view('channels', compact('channels', 'title'));
    }
    
    public function search(Request $request)
    {
        $channels = User::where('name', 'like', "%{$request->term}%")->paginate(12);
        $title = ' عرض نتائج البحث عن: ' . $request->term;
        return view('channels', compact('channels', 'title'));
    }

    public function adminIndex(){

        $channels = User::all();

        return view('admin.channels.index', compact('channels'));
    }

    public function adminUpdate(Request $request, User $channel)
    {
        $channel->administration_level = $request->administration_level;

        $channel->save();

        session()->flash('flash_message', 'تم تعديل صلاحيات القناة بنجاح');

        return redirect(route('channels.index'));
    }

    public function adminDestroy(User $user)
    {
        $user->delete();

        session()->flash('flash_message', 'تم حذف القناة بنجاح');

        return redirect(route('channels.index'));
    }

    public function adminBlock(User $user)
    {
        $user->block = !$user->block;
        $user->save();


        $message = $user->block ? ' حظر' : 'الغاء حظر';

        session()->flash('flash_message', 'تم '.$message.' القناة بنجاح');

        return redirect(route('channels.index'));
    }

    public function blockedChannels()
    {
        $channels = User::where('block', 1)->get();
        return view('admin.channels.blocked-channels', compact('channels'));
    }

    public function allChannels() {
        $channels = User::all()->sortByDesc('created_at');
        return view('admin.channels.all', compact('channels'));
    }
}
