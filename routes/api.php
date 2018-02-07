<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$group_v1 = [
    'version'   => 'v1',
    'namespace' => 'App\\Http\\Controllers\\Api\\',
];

$api->group($group_v1, function ($api) {
    $api->post('wechat/auth', 'WechatAuthController@store');
    $api->get('index', 'IndexController@index')->name('api.index.index');
});

$api->group(array_merge($group_v1, ['middleware' => ['jwt.auth', 'jwt.refresh']]), function ($api) {
    // $api->get('index', 'IndexController@index');
});
