<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
class NoticeController extends Controller
{
    function index(){
        //当前user的通知
        $user= \Auth::user();
        $notices = $user->notices;

        return view('notice/index',compact('notices','user'));
    }
}