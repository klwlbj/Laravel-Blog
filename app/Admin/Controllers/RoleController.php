<?php

namespace App\Admin\Controllers;

class RoleController extends Controller{

    function index(){
        return view('admin.role.index');
    }
    //创建角色
    function create(){
        return view('admin.role.add');

    }
    //创建角色行为
    function store(){

    }
    //角色权限关系页面
    function permission(){
        return view('admin.role.permission');

    }
    //角色权限关系行为
    function storePermission(){

    }
}