<?php

namespace App;


use \App\Model;
class AdminRole extends Model
{
    protected  $table = 'admin_roles';
    //当前角色的所有权限
    function permissions(){
        return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_role','role_id','permission_id')->withPivot(['permission_id','role_id']);

    }
    //给角色賦予權限
    function grantPermission($permission){
        return$this->permissions()->save($permission);
    }
    // //给角色删除權限
    function deletePermission($permission){
        return$this->permissions()->detach($permission);
    }

    //判断角色是否有权限
    function hasPermission($permission){
        return $this->permissions()->countains($permission);
    }
}
