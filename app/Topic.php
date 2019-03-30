<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use \App\Model;
class Topic extends Model
{
    //属于这个专题的所有文章
    function posts(){
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id'); //多对多
    }
    //专题文章数
    function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }
}
