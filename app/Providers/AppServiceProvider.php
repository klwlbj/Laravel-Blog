<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() //注册前调用
    {
        //mb4sting 4bype 对一字符
        Schema::defaultStringLength(191);//
        \View::composer('layout.sidebar',function ($view){
            $topics = \App\Topic::all();
            $view->with('topics',$topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()//注册后调用
    {
        //
    }
}
