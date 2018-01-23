<?php

Route::get('/admin/login', 'Admin\AuthController@login')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@check')->name('admin.login');
Route::get('/admin/logout', 'Admin\AuthController@logout')->name('admin.logout');

Route::namespace('Admin')->middleware('checkAdminLogin')->group(function () {
    Route::get('/admin', 'IndexController@index')->name('admin.index.index');
    Route::get('/admin/index/welcome', 'IndexController@welcome')->name('admin.index.welcome');
});

Route::namespace('Admin')->middleware('checkAdminLogin', 'checkAdminAcl')->group(function () {

    Route::get('/admin/user/list', 'UserController@list')->name('admin.user.list');
    Route::get('/admin/user/view/{id}', 'UserController@view')->name('admin.user.view');
    Route::get('/admin/user/add', 'UserController@add')->name('admin.user.add');
    Route::post('/admin/user/add', 'UserController@handleAdd')->name('admin.user.add');
    Route::get('/admin/user/edit/{id}', 'UserController@edit')->name('admin.user.edit');
    Route::post('/admin/user/edit/{id}', 'UserController@handleEdit')->name('admin.user.edit');
    Route::get('/admin/user/password/reset/{id}', 'UserController@resetPassword')->name('admin.user.resetPassword');
    Route::post('/admin/user/password/reset/{id}', 'UserController@handleResetPassword')->name('admin.user.resetPassword');

    Route::get('/admin/privilege/group/list', 'PrivilegeGroupController@list')->name('admin.privilegeGroup.list');
    Route::get('/admin/privilege/group/add', 'PrivilegeGroupController@add')->name('admin.privilegeGroup.add');
    Route::post('/admin/privilege/group/add', 'PrivilegeGroupController@handleAdd')->name('admin.privilegeGroup.add');
    Route::get('/admin/privilege/group/edit/{id}', 'PrivilegeGroupController@edit')->name('admin.privilegeGroup.edit');
    Route::post('/admin/privilege/group/edit/{id}', 'PrivilegeGroupController@handleEdit')->name('admin.privilegeGroup.edit');

    Route::get('/admin/privilege/list', 'PrivilegeController@list')->name('admin.privilege.list');
    Route::get('/admin/privilege/add', 'PrivilegeController@add')->name('admin.privilege.add');
    Route::post('/admin/privilege/add', 'PrivilegeController@handleAdd')->name('admin.privilege.add');
    Route::get('/admin/privilege/edit/{id}', 'PrivilegeController@edit')->name('admin.privilege.edit');
    Route::post('/admin/privilege/edit/{id}', 'PrivilegeController@handleEdit')->name('admin.privilege.edit');
    Route::get('/admin/user/privilege/manage', 'PrivilegeController@manage')->name('admin.privilege.manage');
    Route::post('/admin/user/privilege/manage', 'PrivilegeController@handleManage')->name('admin.privilege.manage');

    Route::get('/admin/article/list', 'ArticleController@list')->name('admin.article.list');
    Route::get('/admin/article/add', 'ArticleController@add')->name('admin.article.add');
    Route::post('/admin/article/add', 'ArticleController@handleAdd')->name('admin.article.add');
    Route::get('/admin/article/edit/{id}', 'ArticleController@edit')->name('admin.article.edit');
    Route::post('/admin/article/edit/{id}', 'ArticleController@handleEdit')->name('admin.article.edit');
});
