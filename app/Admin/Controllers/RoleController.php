<?php

namespace App\Admin\Controllers;
use App\AdminRole;
use Illuminate\Http\Request;

class RoleController extends Controller{

    function index(){
        $roles = AdminRole::paginate(10);
        return view('admin.role.index',compact('roles'));
    }
    //创建角色
    function create(){

        return view('admin.role.add');
    }
    //创建角色行为
    function store(){
        //验证
        $this->validate(request(),[
            'name' => 'required|min:3',
            'description' => 'required',
        ]);

        AdminRole::create(request(['name','description']));

        return redirect('/admin/roles');
    }
    //角色权限关系页面
    function permission(AdminRole $role){
        //获取所有权限
        $permissions = \App\AdminPermission::all();

        //获取当前角色权限
        $myPermissions = $role->permissions;
        return view('admin.role.permission',compact('permissions','myPermissions','role'));

    }
    //角色权限关系行为
    function storePermission(AdminRole $role){
        $this->validate(request(),[
            'permissions' => 'required|array'
        ]);

        $permissions = \App\AdminPermission::find(request('permissions'));
        $myPermissions = $role->permissions;

        // 对已经有的权限
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }

        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return back();

    }
}