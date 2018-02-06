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

$api->group(['version' => 'v1', 'namespace' => 'App\\Http\\Controllers\\Api\\'], function ($api) {
    $api->post('wechat/auth', 'WechatAuthController@store');
});

$api->group(['version' => 'v1', 'namespace' => 'App\\Http\\Controllers\\Api\\', 'middleware' => ['jwt.auth', 'jwt.refresh']], function ($api) {

});
