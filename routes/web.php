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
    Route::get('/feedback/of/me', 'FeedbackController@ofMe')->name('feedback.ofMe');

    Route::get('customer/service/list', 'CustomerServiceController@list')->name('customerService.list');
    Route::get('customer/service/open', 'CustomerServiceController@open')->name('customerService.open');

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
