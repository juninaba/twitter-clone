<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');
// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');
// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// ログインユーザー
Route::get('/user', function () {
    return Auth::user();
})->name('user');

// tweet投稿
Route::post('/tweets', 'TweetController@create')->name('tweet.create');
// tweet一覧
Route::get('/tweets', 'TweetController@index')->name('tweet.index');
// tweet詳細
Route::get('/tweets/{id}', 'TweetController@show')->name('tweet.show');

// user詳細
Route::get('/users/{id}', 'UserController@show')->name('user.show');
// user編集
Route::get('/users/{id}/edit', 'UserController@edit')->name('user.edit');
// user保存
Route::post('/users/{id}/update', 'UserController@update')->name('user.update');
// follow
Route::get('/users/{id}/follow', 'UserController@follow')->name('user.follow');
// followed
Route::get('/users/{id}/followed', 'UserController@followed')->name('user.followed');

// フォローする
Route::post('/follow-users', 'FollowUserController@store');


Route::delete('/follow-users/{id}', 'FollowUserController@destroy');

