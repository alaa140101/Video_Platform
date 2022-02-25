<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function saveComment(Request $request) {
        $videoId = $request->videoId;
        $userComment = $request->comment;

        $video = Video::find($videoId);

        $comment = new Comment();

        $user = Auth::user();

        $comment->body = $userComment;
        $comment->user_id = $user->id;
        $comment->video_id = $videoId;

        $comment->save();

        $userName = auth()->user()->name;
        $userImage = auth()->user()->profile_photo_url;
        $commentDate = Carbon::now()->diffForHumans();
        $commentId = $comment->id;

        return response()->json(['userName' => $userName, 'commentDate' => $commentDate, 'userImage' => $userImage, 'commentId' => $commentId]);
    }
}
