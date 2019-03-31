<?php

namespace App;

use \App\Model;
use Illuminate\Foundation\Auth\User as Auth;

class AdminUser extends Auth
{
    protected $guarded=[];//不可注入字段

    protected $rememberTokenName = null;  //不用remembertoken
    //用戶的角色
    function roles(){
        return $this->belongsToMany(\App\AdminRole::class,'admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);//获取系表字段，多对多的关系用belongstomany
    }
    //判断一个用戶是否在某人角色里
    function isInRoles($roles){
        return !!$roles->intersect($this->roles())->count();
        //加!!,显示bool值，true或false,
    }
    //给用戶分配角色
    function assignRole($role){
        return $this->roles()->save($role);
    }
    function deleteRole($role){
        return $this->roles()->detach($role);//删除关系
    }
    //用戶是否有权限
    function hasPermission($permission){
        return $this->isInRoles($permission->roles);
    }
}
