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

Route::namespace('Home')->middleware('wechat')->group(function () {
    Route::get('/home/index', 'IndexController@index')->name('home.index');

    Route::get('/member/profile',  'MemberController@profile')->name('member.profile');
    Route::post('/member/profile', 'MemberController@updateProfile')->name('member.updateProfile');

    Route::get('/feedback/add',   'FeedbackController@add')->name('feedback.add');
    Route::post('/feedback/add',  'FeedbackController@handleAdd')->name('feedback.add');
    Route::get('/feedback/of/me', 'FeedbackController@ofMe')->name('feedback.ofMe');

    Route::get('/common/success', function () {
        return view('home.common.message', [
            'msg_type' => 'success',
            'title' => 'success',
            'detail' => 'here is detail asdyourt wahite',
            'primary_btn_desc' => 'Back',
            // 'extra_btn_desc' => 'Back'
        ]);
    });
});

Route::get('/admin/login', 'Admin\AuthController@login')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@check')->name('admin.login');
Route::get('/admin/logout', 'Admin\AuthController@logout')->name('admin.logout');

Route::namespace('Admin')->middleware('checkAdminLogin')->group(function () {
    Route::get('/admin/index', 'IndexController@index')->name('admin.index.index');
});
