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

Route::get('/admin', 'App\Http\Controllers\AdminsController@index')->name('admin.index');
