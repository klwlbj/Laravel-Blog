<?php

namespace App\Admin\Controllers;

use \App\Post; //引入模型

class PermissionController extends Controller {
    function index(){
        return view('admin/permission/index');
    }
    //创建权限
    function create(){
        return view('admin/permission/add');

    }
    //创建权限行为
    function store(){

    }

}