<?php

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

// 認証関連
// TODO: ミドルウェア設定、整理
Route::get('twitterSignIn', 'Auth\TwitterSignInController@register');
Route::get('registerCallBack', 'Auth\TwitterSignInController@callback');
Auth::routes();

// 表示関連
Route::get('/', 'HomeController@index')->name('home');
Route::post('/tweet/search', 'TweetController@search');
Route::post('/tweet/save', 'TweetController@save');
Route::post('/tweet/delete', 'TweetController@delete');
Route::get('/favorite', 'FavoriteTweetController@favorite')->name('favorite');
