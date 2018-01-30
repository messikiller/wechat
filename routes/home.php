<?php

Route::any('/wechat',                'WechatController@serve');
Route::any('/wechat/oauth/callback', 'WechatController@oauthCallback');

Route::namespace('Home')->middleware('wechat', 'checkLocale')->group(function () {
    Route::get('/home/index', 'IndexController@index')->name('home.index');
    Route::get('/home/index/article/{id}', 'IndexController@viewArticle')->name('home.index.article');

    Route::get('/system/language', 'SystemController@language')->name('home.system.language');
    Route::post('/system/language', 'SystemController@updateLanguage')->name('home.system.language');

    Route::get('/member/profile',  'MemberController@profile')->name('home.member.profile');
    Route::post('/member/profile', 'MemberController@updateProfile')->name('home.member.profile');
    Route::get('/member/machine',  'MemberController@machine')->name('home.member.machine');
    Route::post('/member/machine', 'MemberController@updateMachine')->name('home.member.machine');

    Route::get('/feedback/add', 'FeedbackController@add')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.add');
    Route::post('/feedback/add', 'FeedbackController@handleAdd')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.add');
    Route::get('/feedback/manual/add', 'FeedbackController@manualAdd')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.manualAdd');
    Route::post('/feedback/manual/add', 'FeedbackController@handleManualAdd')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.manualAdd');
    Route::get('/feedback/of/me', 'FeedbackController@ofMe')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.ofMe');
    Route::get('/feedback/view/{id}', 'FeedbackController@view')->middleware('checkMemberProfile:T|*|*')->name('home.feedback.view');

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
