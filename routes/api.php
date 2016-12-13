<?php

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
/**
 * api
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1_0', function ($api) {
    $api->group(['namespace' => 'App\Api\v1_0\Controllers', 'middleware' => 'access'], function ($api){
        $api->resource('users', 'UserController');
        $api->post('auth/login', 'AuthController@login');
        $api->post('auth/register', 'AuthController@register');
        $api->get('auth/user', 'AuthController@getUserInfo');
    });
});