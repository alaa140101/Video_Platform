<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Convertedvideo;

class ConvertedVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $converted_video1 = Convertedvideo::create([
            'video_id' => Video::where('title', 'Flowers')->first()->id,
            'mp4_Format_240' => 'test/240-Flowers.mp4',
            'mp4_Format_360' => 'test/360-Flowers.mp4',
            'mp4_Format_480' => 'test/480-Flowers.mp4',
            'mp4_Format_720' => 'test/720-Flowers.mp4',
            'mp4_Format_1080' => 'No Video',
            /*'webm_Format_240' => 'test/240-Flowers.webm',
            'webm_Format_360' => 'test/360-Flowers.webm',
            'webm_Format_480' => 'test/480-Flowers.webm',
            'webm_Format_720' => 'test/720-Flowers.webm',
            'webm_Format_1080' => 'No Video',*/
        ]);
        $converted_video2 = Convertedvideo::create([
            'video_id' => Video::where('title', 'People')->first()->id,
            'mp4_Format_240' => 'test/240-People.mp4',
            'mp4_Format_360' => 'test/360-People.mp4',
            'mp4_Format_480' => 'test/480-People.mp4',
            'mp4_Format_720' => 'No Video',
            'mp4_Format_1080' => 'No Video',
            /*'webm_Format_240' => 'test/240-Flowers.webm',
            'webm_Format_360' => 'test/360-Flowers.webm',
            'webm_Format_480' => 'test/480-Flowers.webm',
            'webm_Format_720' => 'test/720-Flowers.webm',
            'webm_Format_1080' => 'No Video',*/
        ]);
        $converted_video3 = Convertedvideo::create([
            'video_id' => Video::where('title', 'Seoul')->first()->id,
            'mp4_Format_240' => 'test/240-Seoul.mp4',
            'mp4_Format_360' => 'test/360-Seoul.mp4',
            'mp4_Format_480' => 'No Video',
            'mp4_Format_720' => 'No Video',
            'mp4_Format_1080' => 'No Video',
            /*'webm_Format_240' => 'test/240-Flowers.webm',
            'webm_Format_360' => 'test/360-Flowers.webm',
            'webm_Format_480' => 'test/480-Flowers.webm',
            'webm_Format_720' => 'test/720-Flowers.webm',
            'webm_Format_1080' => 'No Video',*/
        ]);
    }
}
