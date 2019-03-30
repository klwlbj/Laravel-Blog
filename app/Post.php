<?php

namespace App;

use Laravel\Scout\Searchable;
use \App\Model;
use Illuminate\Database\Eloquent\Builder;
 //表 => posts
class Post extends Model
{
    use Searchable;
    //定义索引里的type
    public function searchableAs()
    {
        return'post';
    }
    //定义有哪些字段需要搜索
    function toSearchableArray(){
        return[
            'title'=>$this->title,
        'content'=>$this->content,
        ];
    }
    //关联用户
    public  function  user(){
        return $this->belongsTo('App\User'); //反向关联
    }
    //评论模型
    public  function comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
    //用户赞关联
    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //文章的所有赞
    public function  zans(){
        return $this->hasMany(\App\Zan::class);
    }
    //属于某个作者的文章
    public function scopeAuthorBy(Builder $query,$user_id){
        return $query->where('user_id',$user_id);

    }


    function postTopics(){ //获取posttopic
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }
    //不属于某个专题的文章
    function scopeTopicNotBy(Builder $query,$topic_id){
        return $query->doesntHave('postTopics','and',function ($q) use($topic_id){
            $q->where('topic_id',$topic_id); //匿名函数 use
        });

    }

}
