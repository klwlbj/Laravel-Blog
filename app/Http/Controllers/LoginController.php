<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login/index');
    }
    public function login(){
        //验证
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_rememble'=>'integer',
        ]);
        //逻辑
        $user= \request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if(\Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }

        //渲染
        return \Redirect::back()->withErrors('账号密码错误');
    }
    public function logout(){
        \Auth::logout();
        return redirect('/login');
    }
}
