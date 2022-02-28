<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $data = \Carbon\Carbon::today()->subDays(7);
        $title = 'الفيديوهات الاكثر مشاهدة خلال هذا الاسبوع';
        $videos = Video::join('views', 'videos.id', '=', 'views.video_id')
                        ->orderBy('views.views_number', 'Desc')
                        ->where('videos.created_at', '>=', $data)
                        ->get('videos.*');

        return view('main', compact('videos', 'title'));
    }

    public function channelsVideos(User $channel)
    {
        $videos = Video::where('user_id', $channel->id)->get();
        $title = ' جميع الفيديوهات الخاصة بالقناة ' . $channel->name;
        return view('videos.my-videos', compact('videos', 'title'));
    }
}
