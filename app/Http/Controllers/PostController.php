<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use \App\Post; //App前加\表示根目录，App不是app
use \App\Zan;

class PostController extends Controller
{
    //列表
    public function index(){
        $posts = Post::orderBy('created_at','desc')->withCount('comments','zans')->paginate(10);

        return view('post/index',compact('posts')); //第二个参数放变量
    }
    //详情页
    public function show(Post $post){ //绑定路由中的post对象,依赖注入,不用实例化,即 $post= new Post
        $post->load('comments');  //预加载，防止在view层查询
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
        $user_id = \Auth::id();
        $params= array_merge(request(['title','content']),compact('user_id'));

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
        $this->authorize('update',$post);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect("/posts/{$post->id}");

    }
    //del逻辑
    public function delete(Post $post){
        $this->authorize('delete',$post);
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
    public function comment(post $post){
        $this->validate(request(),[
            'content' => 'required|string|min:2',
        ]);
        $comment= new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        return back(); //直接返回
    }
    public function zan(post $post){
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($param);//先查找，没有则创建
        return back();
    }
    public function unzan(post $post){
        $post->zan(\Auth::id())->delete();
        return back();
    }
    function search(){
//        验证
        $this->validate(\request(),[
            'query'=>'required',
        ]);
//        逻辑
        $query = \request('query');
        $posts = \App\Post::search($query)->paginate(2);
//        渲染
        return view('post.search',compact('posts','query'));
    }

}
