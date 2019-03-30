<?php

namespace App\Admin\Controllers;

use \App\Post; //引入模型

class PostController extends Controller {
    function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('admin/post/index',compact('posts'));
    }
    function status(Post $post){

    }
}