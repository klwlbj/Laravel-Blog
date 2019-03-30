<?php

namespace App\Admin\Controllers;

class LoginController extends Controller{

    function index(){
        return view('admin/login/index');
    }
    function login(){
        $this->validate(request(),[
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:10',
        ]);
        //逻辑
        $user= \request(['name','password']);
        if(\Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }

        //渲染
        return \Redirect::back()->withErrors('用户名密码错误');
    }
    function logout(){
        \Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}