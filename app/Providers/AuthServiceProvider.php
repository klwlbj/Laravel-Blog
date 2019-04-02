<?php

namespace App\Providers;

use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy', //注册权限控制
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = \App\AdminPermission::all();//获取所有权限
        foreach ($permissions as $permission)//对每个权限定义门卫
        {
            Gate::define($permission->name,function($user)use($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}
