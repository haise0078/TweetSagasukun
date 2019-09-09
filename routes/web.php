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
Route::get('twitterSignIn', 'Auth\TwitterSignInController@register');
Route::get('registerCallBack', 'Auth\TwitterSignInController@callback');
Auth::routes();

// 表示関連
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::post('/tweet/search', 'TweetController@search');
