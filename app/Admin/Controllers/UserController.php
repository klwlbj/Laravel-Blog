<?php

namespace App\Admin\Controllers;

use \App\AdminUser; //引入模型
class UserController extends Controller{
    //管理员列表
    function  index(){
        $users = AdminUser::paginate(10);
        return view('/admin/user/index',compact('users'));
    }
//管理员创建页面
    function create(){
        return view('admin.user.add');
//创建操作
    }
    function  store(){
        //验证
        $this->validate(request(),[
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:10',
        ]);
        //逻辑
        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name','password'));

        return redirect('/admin/users');
    }
    function del(AdminUser $admin_user){
        $admin_user->delete($admin_user);
        return back();
    }



}