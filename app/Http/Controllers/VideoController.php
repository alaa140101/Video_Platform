<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Video;
use Storage;

use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use FFMpeg;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.uploader');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|required',
            'video' => 'required',
        ]);

        $randomPath = Str::random(16);
        $videoPath = $randomPath . '.' . $request->video->getClientOriginalExtension();
        $imagePath = $randomPath . '.' . $request->video->getClientOriginalExtension();

        $image = Image::make($request->image)->resize(320, 180);
        $path = Storage::put($imagePath, $image->stream());        

        $request->video->storeAs('/', $videoPath, 'public');

        $video = Video::create([
            'disk' => 'public',
            'video_path' => $videoPath,
            'image_path' => $imagePath,
            'title' => $request->title,
            'user_id' => auth()->id(),
        ]);

        // $lowBitrateFormat = (new X264('acc', 'libx264'))->setKiloBitrate(500);
        // $low2_BitrateFormat = (new X264('acc', 'libx264'))->setKiloBitrate(900);
        // $mediumBitrateFormate = (new X264('acc', 'libx264'))->setKiloBitrate(1500);
        // $highBitrateFormate = (new X264('acc', 'libx264'))->setKiloBitrate(3000);

        $lowBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500);
        $low2_BitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(900);
        $mediumBitrateFormate = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(1500);
        $highBitrateFormate = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(3000);
        
        $convertedName = '240-'.$video->video_path;
        $convertedName_360 = '360-'.$video->video_path;
        $convertedName_480 = '480-'.$video->video_path;
        $convertedName_720 = '720-'.$video->video_path;

        FFMpeg::fromDisk($video->disk)
            ->open($video->video_path)

            ->addFilter(function ($filters) {
                $filters->resize(new Dimension(426, 240));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($lowBitrateFormat)
            ->save($convertedName)

            ->addFilter(function ($filters) {
                $filters->resize(new Dimension(640, 360));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($low2_BitrateFormat)
            ->save($convertedName_360)

            ->addFilter(function ($filters) {
                $filters->resize(new Dimension(854, 480));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($mediumBitrateFormate)
            ->save($convertedName_480)

            ->addFilter(function ($filters) {
                $filters->resize(new Dimension(1280, 720));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($highBitrateFormate)
            ->save($convertedName_720);

            return redirect()->back()->with(
                'success',
                'سيكون مقطع الفيديو متوفر عندما تتنتهى معالجته'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
