<?php

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    // 需要登陆的
//    Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/home', '\App\Admin\Controllers\HomeController@index');

    // 系统管理
    Route::group(['middleware' => 'can:system'], function () {
        // 用户管理
        Route::get('/users', '\App\Admin\Controllers\UserController@index');
        Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
        Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
        Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');
        Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@storeRole');

        // 角色管理
        Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
        Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
        Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
        Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
        Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');

        // 权限管理
        Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
        Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
        Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');
    });

    // 文章管理
    Route::group(['middleware' => 'can:post'], function () {
        // 文章管理
        Route::get('/posts', '\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
    });

    // 专题模块
//    Route::group(['middleware' => 'can:topic'], function () {
        Route::resource('topics', '\App\Admin\Controllers\TopicController', [
            'only' => [
                'index',
                'create',
                'store',
                'destroy'
            ]
        ]);
//    });

    // 通知模块
    Route::group(['middleware' => 'can:notice'], function () {
        Route::resource('notices', '\App\Admin\Controllers\NoticeController', [
            'only' => ['index', 'create', 'store'],
        ]);
    });
//    });

    //
    /**
     * 学校管理
     */
    Route::get('/schools', '\App\Admin\Controllers\SchoolController@index');
    // 新增界面
    Route::get('schools/create', [
        'as' => 'schools.create',
        'uses' => '\App\Admin\Controllers\SchoolController@create'
    ]);

    // 编辑界面
    Route::get('schools/create/{id}', [
        'as' => 'schools.update',
        'uses' => '\App\Admin\Controllers\SchoolController@create'
    ]);

    Route::post('/schools/store', '\App\Admin\Controllers\SchoolController@store');
    Route::post('/schools/{school}/delete', '\App\Admin\Controllers\SchoolController@delete');

    /**
     * 专业管理
     */
    Route::get('/majors', '\App\Admin\Controllers\MajorController@index');
    // 新增界面
    Route::get('majors/create', [
        'as' => 'majors.create',
        'uses' => '\App\Admin\Controllers\MajorController@create'
    ]);

    // 编辑界面
    Route::get('majors/create/{id}', [
        'as' => 'majors.update',
        'uses' => '\App\Admin\Controllers\MajorController@create'
    ]);

    Route::post('/majors/store', '\App\Admin\Controllers\MajorController@store');
    Route::post('/majors/{major}/delete', '\App\Admin\Controllers\MajorController@delete');

    /**
     * 说说管理
     */
    Route::get('/shuoshuos', '\App\Admin\Controllers\ShuoshuoController@index');
    // 新增界面
    Route::get('shuoshuos/create', [
        'as' => 'shuoshuos.create',
        'uses' => '\App\Admin\Controllers\ShuoshuoController@create'
    ]);

    // 编辑界面
    Route::get('shuoshuos/create/{id}', [
        'as' => 'shuoshuos.update',
        'uses' => '\App\Admin\Controllers\ShuoshuoController@create'
    ]);

    Route::post('/shuoshuos/store', '\App\Admin\Controllers\ShuoshuoController@store');
    Route::post('/shuoshuos/{shuoshuo}/delete', '\App\Admin\Controllers\ShuoshuoController@delete');
});
