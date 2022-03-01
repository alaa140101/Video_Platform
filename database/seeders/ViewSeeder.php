<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Video;
use App\Models\View;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view1 = View::create([
            'user_id' => User::where('name', 'academy-hsoub')->first()->id,
            'video_id' => Video::where('title', 'Seoul')->first()->id,
            'views_number' => '70',
        ]); 
        $view2 = View::create([
            'user_id' => User::where('name', 'Ana')->first()->id,
            'video_id' => Video::where('title', 'Flowers')->first()->id,
            'views_number' => '50',
        ]); 
        $view3 = View::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'video_id' => Video::where('title', 'People')->first()->id,
            'views_number' => '30',
        ]); 
    }
}
