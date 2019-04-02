 <?php



Route::group(['prefix'=>'admin'],function(){
    Route::get('/login','\App\Admin\Controllers\LoginController@index');//login
    Route::post('/login','\App\Admin\Controllers\LoginController@login');//login behavior
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');//logout behavior

    //中间件，登陆后操作
    Route::group(['middleware'=>'auth:admin'],function (){
        Route::get('/home','\App\Admin\Controllers\HomeController@index');//index
        Route::group(['middleware'=>'can:system'],function(){
            //管理人员模块
            Route::get('/users','\App\Admin\Controllers\UserController@index');
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');
            Route::post('/users/store','\App\Admin\Controllers\UserController@store');
            Route::get('/users/del/{admin_user}','\App\Admin\Controllers\UserController@del');
            Route::get('/users/{user}/role','\App\Admin\Controllers\UserController@role');//用户角色关联页面
            Route::post('/users/{user}/role','\App\Admin\Controllers\UserController@storeRole');
            //角色模块
            Route::get('/roles','\App\Admin\Controllers\RoleController@index');
            Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');
            Route::post('/roles/store','\App\Admin\Controllers\RoleController@store');
            Route::get('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');//角色权限关联页面
            Route::post('/roles/{role}/permission','\App\Admin\Controllers\RoleController@storePermission');
            //权限模块
            Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');
            Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');
            Route::post('/permissions/store','\App\Admin\Controllers\PermissionController@store');
        });
        Route::group(['middleware'=>'can:post'],function(){
            //审核模块
            Route::get('/posts','\App\Admin\Controllers\PostController@index');//index
            Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');//index
        });
        Route::group(['middleware'=>'can:topic'],function(){
            //话题模块
//            Route::resource('topics','\App\Admin\Controllers\TopicController',['only'=>['index','create','store','destroy']]);//使用resource
            Route::resource('topics', '\App\Admin\Controllers\TopicController', ['only' => [
                'index', 'create', 'store', 'destroy'
            ]]);
        });
    });

});
