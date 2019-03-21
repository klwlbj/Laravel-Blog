<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post; //App前加\表示根目录，App不是app

class PostController extends Controller
{
    //列表
    public function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('post/index',compact('posts')); //第二个参数放变量
    }
    //详情页
    public function show(Post $post){ //绑定路由中的post对象,依赖注入,不用实例化,即 $post= new Post
        return view('post/show',compact('post'));
    }
    //创建
    public function create(){
        return view('post/create');
    }
    //创建逻辑
    public function store(){
        $this->validate(request(),[
            'title' => 'required|string|min:5|max:100',
            'content' => 'required|string|min:10',
        ]);
        $params= request(['title','content']);
        $post=Post::create($params);
        return redirect('/posts');
        //dd($post);
    }
    //编辑
    public function edit(Post $post){
        return view('post/edit',compact('post'));

    }
    //编辑逻辑
    public function update(Post $post){
        $this->validate(request(),[
            'title' => 'required|string|min:5|max:100',
            'content' => 'required|string|min:10',
        ]);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect("/posts/{$post->id}");

    }
    //del逻辑
    public function delete(Post $post){
        $post->delete();
        return redirect('/posts');
    }
    //pic up
    public function imageUpload(Request $request){

        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        //dd($path);
        return asset('storage/'.$path);
       //dd(request()->all());
    }


}