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

    Route::get('/care/doctor/endoscope', 'CareController@endoDoctor')->name('care.endoDoctor');
    Route::get('/care/doctor/ultrasound', 'CareController@ultraDoctor')->name('care.ultraDoctor');
    Route::get('/care/provider/center', 'CareController@providerCenter')->name('care.providerCenter');

    Route::get('/support/news', 'SupportController@news')->name('support.news');
    Route::get('/support/ultrasound', 'SupportController@ultrasound')->name('support.ultrasound');
    Route::get('/support/endoscope', 'SupportController@endoscope')->name('support.endoscope');

    Route::get('/about/us', 'AboutController@us')->name('about.us');
    Route::get('/about/globe', 'AboutController@globe')->name('about.globe');
    Route::get('/about/contact', 'AboutController@contact')->name('about.contact');
});
