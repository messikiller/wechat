<?php

Route::any('/wechat',                'WechatController@serve');
Route::any('/wechat/oauth/callback', 'WechatController@oauthCallback');

Route::namespace('Home')->middleware('wechat')->group(function () {
    Route::get('/home/index', 'IndexController@index')->name('home.index');
    Route::get('/home/index/article/{id}', 'IndexController@viewArticle')->middleware('checkMemberProfile:T|*|*')->name('home.index.article');

    Route::get('/member/profile',  'MemberController@profile')->name('home.member.profile');
    Route::post('/member/profile', 'MemberController@updateProfile')->name('home.member.updateProfile');

    Route::get('/feedback/add',   'FeedbackController@add')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.add');
    Route::post('/feedback/add',  'FeedbackController@handleAdd')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.add');
    Route::get('/feedback/of/me', 'FeedbackController@ofMe')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.ofMe');

    Route::get('/care/doctor/endoscope', 'CareController@endoDoctor')->middleware('checkMemberProfile:T|D|D-T|D|E-T|P|E')->name('home.care.endoDoctor');
    Route::get('/care/doctor/ultrasound', 'CareController@ultraDoctor')->middleware('checkMemberProfile:T|D|D-T|D|U-T|P|U')->name('home.care.ultraDoctor');
    Route::get('/care/provider/center', 'CareController@providerCenter')->middleware('checkMemberProfile:T|P|U-T|P|E')->name('home.care.providerCenter');

    Route::get('/support/news', 'SupportController@news')->name('home.support.news');
    Route::get('/support/ultrasound/center', 'SupportController@ultrasound')->middleware('checkMemberProfile:T|D|U-T|P|U')->name('home.support.ultrasound');
    Route::get('/support/endoscope/center', 'SupportController@endoscope')->middleware('checkMemberProfile:T|D|E-T|P|E')->name('home.support.endoscope');
    Route::get('/support/endoscope/maintain', 'SupportController@endoMaintain')->middleware('checkMemberProfile:T|D|E-T|P|E')->name('home.support.endoMaintain');

    Route::get('/about/us', 'AboutController@us')->name('home.about.us');
    Route::get('/about/globe', 'AboutController@globe')->middleware('checkMemberProfile:T|D|U-T|P|U-T|D|E-T|P|E')->name('home.about.globe');
    Route::get('/about/contact', 'AboutController@contact')->name('home.about.contact');
});
