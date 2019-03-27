<?php

namespace App;

use Laravel\Scout\Searchable;
use \App\Model;
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
}
