 <?php



Route::group(['prefix'=>'admin'],function(){
    Route::get('/login','\App\Admin\Controllers\LoginController@index');//login
    Route::post('/login','\App\Admin\Controllers\LoginController@login');//login behavior
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');//logout behavior

    //中间件，登陆后操作
    Route::group(['middleware'=>'auth:admin'],function (){
        Route::get('/home','\App\Admin\Controllers\HomeController@index');//index
        //管理人员模块
        Route::get('/users','\App\Admin\Controllers\UserController@index');
        Route::get('/users/create','\App\Admin\Controllers\UserController@create');

        Route::post('/users/store','\App\Admin\Controllers\UserController@store');
        Route::get('/users/del/{admin_user}','\App\Admin\Controllers\UserController@del');

        //审核模块
        Route::get('/posts','\App\Admin\Controllers\PostController@index');//index
        Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');//index

    });

});
