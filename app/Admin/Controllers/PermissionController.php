<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use \App\AdminUser; //引入模型

class PermissionController extends Controller {
    function index(){
        $permissions = AdminPermission::paginate(10);
        return view('admin/permission/index',compact('permissions'));
    }
    //创建权限
    function create(){
        return view('admin/permission/add');

    }
    //创建权限行为
    function store(){
        //验证
        $this->validate(request(),[
            'name' => 'required|min:3',
            'description' => 'required',
        ]);

        AdminPermission::create(request(['name','description']));
        return redirect('/admin/permissions');
    }

}