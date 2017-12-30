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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/wechat',                'WechatController@serve');
Route::any('/wechat/oauth/callback', 'WechatController@oauthCallback');

Route::namespace('Home')
    // ->middleware('wechat')
    ->group(function () {
        Route::get('/index', 'IndexController@index')->name('home.index');

        Route::get('/member/profile',  'MemberController@profile')->name('member.profile');
        Route::post('/member/profile', 'MemberController@updateProfile')->name('member.profile');
});
