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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.main');
})->name('dashboard');

Route::resource('/videos', 'App\Http\Controllers\VideoController');

Route::get('/video/search', 'App\Http\Controllers\VideoController@search')->name('video.search');
Route::post('/like', 'App\Http\Controllers\LikeController@LikeVideo')->name('like');

Route::post('/view', 'App\Http\Controllers\VideoController@addView')->name('view');
