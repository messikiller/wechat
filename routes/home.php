<?php

Route::any('/wechat',                'WechatController@serve');
Route::any('/wechat/oauth/callback', 'WechatController@oauthCallback');

Route::namespace('Home')->middleware('wechat')->group(function () {
    Route::get('/home/index', 'IndexController@index')->name('home.index');
    Route::get('/home/index/article/{id}', 'IndexController@viewArticle')->name('home.index.article');

    Route::get('/member/profile',  'MemberController@profile')->name('home.member.profile');
    Route::post('/member/profile', 'MemberController@updateProfile')->name('home.member.updateProfile');

    Route::get('/feedback/add',   'FeedbackController@add')->name('home.feedback.add');
    Route::post('/feedback/add',  'FeedbackController@handleAdd')->name('home.feedback.add');
    Route::get('/feedback/of/me', 'FeedbackController@ofMe')->name('home.feedback.ofMe');

    Route::get('/care/doctor/endoscope', 'CareController@endoDoctor')->name('home.care.endoDoctor');
    Route::get('/care/doctor/ultrasound', 'CareController@ultraDoctor')->name('home.care.ultraDoctor');
    Route::get('/care/provider/center', 'CareController@providerCenter')->name('home.care.providerCenter');

    Route::get('/support/news', 'SupportController@news')->name('home.support.news');
    Route::get('/support/ultrasound', 'SupportController@ultrasound')->name('home.support.ultrasound');
    Route::get('/support/endoscope', 'SupportController@endoscope')->name('home.support.endoscope');

    Route::get('/about/us', 'AboutController@us')->name('home.about.us');
    Route::get('/about/globe', 'AboutController@globe')->name('home.about.globe');
    Route::get('/about/contact', 'AboutController@contact')->name('home.about.contact');
});
