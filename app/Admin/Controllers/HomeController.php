<?php

namespace App\Admin\Controllers;

class HomeController extends Controller{
    function index(){
        return view('admin/home/index');
    }
}