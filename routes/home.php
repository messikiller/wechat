<?php

Route::any('/wechat',                'WechatController@serve');
Route::any('/wechat/oauth/callback', 'WechatController@oauthCallback');

Route::namespace('Home')->middleware('wechat')->group(function () {
    Route::get('/home/index', 'IndexController@index')->name('home.index');

    Route::get('/member/profile',  'MemberController@profile')->name('member.profile');
    Route::post('/member/profile', 'MemberController@updateProfile')->name('member.updateProfile');

    Route::get('/feedback/add',   'FeedbackController@add')->name('feedback.add');
    Route::post('/feedback/add',  'FeedbackController@handleAdd')->name('feedback.add');
    Route::get('/feedback/of/me', 'FeedbackController@ofMe')->name('feedback.ofMe');
});
