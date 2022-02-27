<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Video;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1 = Comment::create([
            'user_id' => User::where('name', 'academy-hsoub')->first()->id,
            'video_id' => Video::where('title', 'People')->first()->id,
            'body' => 'المشاة لايتوقفون',
        ]);
        $comment2 = Comment::create([
            'user_id' => User::where('name', 'Ana')->first()->id,
            'video_id' => Video::where('title', 'People')->first()->id,
            'body' => 'المشاة في لاشتاء',
        ]);
        $comment3 = Comment::create([
            'user_id' => User::where('name', 'Mana')->first()->id,
            'video_id' => Video::where('title', 'People')->first()->id,
            'body' => 'المشاة يعبرون',
        ]);
        $comment4 = Comment::create([
            'user_id' => User::where('name', 'Khamsat')->first()->id,
            'video_id' => Video::where('title', 'Flowers')->first()->id,
            'body' => 'الورود جميلة',
        ]);
        $comment5 = Comment::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'video_id' => Video::where('title', 'Flowers')->first()->id,
            'body' => 'الوردو طويلة',
        ]);
        $comment6 = Comment::create([
            'user_id' => User::where('name', 'academy-hsoub')->first()->id,
            'video_id' => Video::where('title', 'Flowers')->first()->id,
            'body' => 'الورود حمراء',
        ]);
        $comment7 = Comment::create([
            'user_id' => User::where('name', 'Ana')->first()->id,
            'video_id' => Video::where('title', 'Seoul')->first()->id,
            'body' => 'العاصمة كبيرة',
        ]);
        $comment8 = Comment::create([
            'user_id' => User::where('name', 'academy-hsoub')->first()->id,
            'video_id' => Video::where('title', 'Seoul')->first()->id,
            'body' => 'العاصمة مزدحمة',
        ]);
        $comment9 = Comment::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'video_id' => Video::where('title', 'Seoul')->first()->id,
            'body' => 'العاصمة مضيئة',
        ]);       
    }
}
