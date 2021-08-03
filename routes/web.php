<?php

use App\Events\VideoView;
use App\Video;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Auth::routes();

Route::get('/', 'TweetsController@index')->name('home');
Route::get('/tweet/{tweet}', 'TweetsController@show')->name('tweet');
Route::post('/', 'TweetsController@store');

Route::prefix('/profile/{user}')->group(function() {
    Route::get('', 'ProfileController@show')->name('profile');
    Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/update', 'ProfileController@update')->name('profile.update');
    Route::post('/toggle-follow', 'FollowController@store')->name('toggle-follow');
});

Route::prefix('/chats')->group(function() {
  Route::get('', 'ChatController@index')->name('chats');
  Route::post('/{id}', 'ChatController@show')->name('chats.show');
  Route::patch('/messages/{id}', 'ChatController@update')->name('chats.messages.update');
  Route::post('/{id}/send', 'ChatController@store')->name('chat.store');

});

Route::get('/explore', 'ExploreController@index')->name('explore');

Route::post('/like/{tweet}', 'LikeController@store')->name('like');
