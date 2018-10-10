<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'domain'    => config('const.admin_domain'),
], function () {
//    Route::match(['get', 'post'], '/', 'IndexController@index');
    // 登录
    Route::match(['get', 'post'], '/login', 'IndexController@login');
    // 退出
    Route::match(['get', 'post'], '/logout', 'IndexController@logout');

    Route::group(['prefix' => 'ajax'], function () {
        // ajax 是否登陆
        Route::match(['get', 'post'], '/isLogin', 'AjaxController@isLogin');
        // ajax 获取省市区数据
        Route::match(['get', 'post'], '/getRegion', 'AjaxController@getRegion');
    });

    Route::group(['middleware' => ['admin_login']], function () {
        // Route::match(['get', 'post'], '/index', 'IndexController@index');

        // 系统用户
        Route::group(['prefix' => 'admin'], function () {
            // 列表
            Route::match(['get', 'post'], '/index', 'AdminController@index');
            // 添加 修改
            Route::match(['get', 'post'], '/save', 'AdminController@save');
            // 获取信息
            Route::match(['get', 'post'], '/info', 'AdminController@info');
            // 桌面
            Route::match(['get', 'post'], '/desk', 'AdminController@desk');
        });

        // 系统角色
        Route::group(['prefix' => 'role'], function () {
            // 列表
            Route::match(['get', 'post'], '/index', 'RoleController@index');
            // 设置 管理后台用户角色 的权限
            Route::match(['get', 'post'], '/permission', 'RoleController@permission');
            // 设置 CRM客户端用户角色 的权限
            Route::match(['get', 'post'], '/clientPermission', 'RoleController@clientPermission');
        });

        // 企业
        Route::group(['prefix' => 'company'], function () {
            // 列表
            Route::match(['get', 'post'], '/index', 'CompanyController@index');
            // 添加 修改
            Route::match(['get', 'post'], '/save', 'CompanyController@save');
            // 获取信息
            Route::match(['get', 'post'], '/info', 'CompanyController@info');
        });
    });
});
