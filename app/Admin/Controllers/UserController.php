<?php

namespace App\Admin\Controllers;

use App\AdminRole;
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
    //用户角色页面
    function role(AdminUser $user){
        $roles = AdminRole::all();
        $myRoles = $user->roles;
        return view('admin.user.role',compact('roles','myRoles','user'));
    }
    //用户角色储存
    function storeRole(AdminUser $user){
        //验证
        $this->validate(request(),[
            'roles' => 'required|array',
        ]);
        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $user->role;
        //增加
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role){
            $user->assignRole($role);
        }
        //删除
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role){
            $user->deleteRole($role);
        }
        return back();

    }



}