<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\MainController@index')->name('main');
Route::get('/main/{channel}/videos', 'App\Http\Controllers\MainController@channelsVideos')->name('main.channels.videos');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.main');
})->name('dashboard');

Route::resource('/videos', 'App\Http\Controllers\VideoController');

Route::get('/video/search', 'App\Http\Controllers\VideoController@search')->name('video.search');
Route::post('/like', 'App\Http\Controllers\LikeController@LikeVideo')->name('like');

Route::post('/view', 'App\Http\Controllers\VideoController@addView')->name('view');

Route::post('/comment', 'App\Http\Controllers\CommentController@saveComment')->name('comment');
Route::get('/comment/{id}/edit', 'App\Http\Controllers\CommentController@edit')->name('comment.edit');
Route::patch('/comment/{id}', 'App\Http\Controllers\CommentController@update')->name('comment.update');
Route::get('/comment/{id}', 'App\Http\Controllers\CommentController@destroy')->name('comment.destroy');

Route::get('/history', 'App\Http\Controllers\HistoryController@index')->name('history');
Route::delete('/history/{id}', 'App\Http\Controllers\HistoryController@destroy')->name('history.destroy');
Route::delete('/destroyAll', 'App\Http\Controllers\HistoryController@destroyAll')->name('history.destroyAll');

Route::get('/channels', 'App\Http\Controllers\ChannelController@index')->name('channels.index');
Route::get('/channels/search', 'App\Http\Controllers\ChannelController@search')->name('channels.search');

Route::post('/notification', 'App\Http\Controllers\NotificationController@index')->name('notification');

Route::prefix('/admin')->middleware('can:update-videos')->group(function() {
    Route::get('/', 'App\Http\Controllers\AdminsController@index')->name('admin.index');
    Route::get('/channels', 'App\Http\Controllers\ChannelController@adminIndex')->name('channels.index');
    Route::patch('/{channel}/channels', 'App\Http\Controllers\ChannelController@adminUpdate')->name('channels.update')->middleware('can:update-users');
    Route::delete('/channels/{user}', 'App\Http\Controllers\ChannelController@adminDestroy')->name('channels.delete')->middleware('can:update-users');
    Route::patch('/{user}/block', 'App\Http\Controllers\ChannelController@adminBlock')->name('channels.block')->middleware('can:update-users');
    Route::get('/channels/blocked', 'App\Http\Controllers\ChannelController@blockedChannels')->name('channels.blocked');
    Route::get('/channels/all', 'App\Http\Controllers\ChannelController@allChannels')->name('channels.all');
    Route::get('/MostViewedVideos', 'App\Http\Controllers\VideoController@mostViewedVideos')->name('most.viewed.video');
});
