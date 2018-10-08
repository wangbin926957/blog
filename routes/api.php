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

Route::group([
    'middleware' => 'api_visit',
    'namespace'  => 'App\Http\Controllers\API',
], function () {
    // 支付宝支付回调
    Route::match(['get', 'post'], '/test', 'TestController@index');
});