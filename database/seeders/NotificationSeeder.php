<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Video;
use App\Models\Notification;


class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification1 = Notification::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'notification' => Video::where('title', 'Seoul')->first()->title,
            'success' => '1',
        ]);
        $notification2 = Notification::create([
            'user_id' => User::where('name', 'academy-hsoub')->first()->id,
            'notification' => Video::where('title', 'Flowers')->first()->title,
            'success' => '1',
        ]);
        $notification3 = Notification::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'notification' => Video::where('title', 'People')->first()->title,
            'success' => '1',
        ]);
    }
}
