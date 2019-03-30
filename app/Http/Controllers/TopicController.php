<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
class TopicController extends Controller
{
    function show(Topic $topic){
        //带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);
        //专题的文章列表，按照时间倒序，前10个
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
        //属于我的文章，但未投稿
//        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();
        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();
        return view('topic/show',compact('topic','posts','myposts'));
    }
    function submit(Topic $topic){
        $this->validate(request(),[
            'post_ids' =>'required|array',
        ]);
        $topic_id = $topic->id;
        $post_ids = request('post_ids');
        foreach($post_ids as $post_id){
            \App\PostTopic::firstOrCreate(compact('topic_id','post_id'));
            }
            return back();
    }


}