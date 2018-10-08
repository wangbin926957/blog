<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Client',
    'domain'    => config('const.client_domain'),
], function () {
    Route::match(['get', 'post'], '/', 'IndexController@index');
    Route::match(['get', 'post'], '/test', 'TestController@index');
    Route::match(['get', 'post'], '/login', 'IndexController@login');

    Route::group(['middleware' => ['client_login']], function () {
        Route::match(['get', 'post'], '/index', 'IndexController@index');
    });
});
