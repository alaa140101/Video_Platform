<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $video1 = Video::create([
            'user_id' => User::where('name', 'academy-hsoub')->first()->id,
            'title' => 'Flowers',
            'disk' => 'test',
            'video_path' => 'test',
            'image_path' => 'test/1.jpg',
            'hours' => '0',
            'minutes' => '0',
            'seconds' => '6',
            'quality' => '720',
            'processed' => '1',
        ]);
        $video2 = Video::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'title' => 'People',
            'disk' => 'test',
            'video_path' => 'test',
            'image_path' => 'test/2.jpg',
            'hours' => '0',
            'minutes' => '0',
            'seconds' => '9',
            'quality' => '480',
            'processed' => '1',
        ]);
        $video3 = Video::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'title' => 'Seoul',
            'disk' => 'test',
            'video_path' => 'test',
            'image_path' => 'test/3.jpg',
            'hours' => '0',
            'minutes' => '0',
            'seconds' => '14',
            'quality' => '360',
            'processed' => '1',
        ]);
    }
}
