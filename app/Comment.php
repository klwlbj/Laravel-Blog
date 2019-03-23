<?php

namespace App;

use \App\Model;

class Comment extends Model
{
    //
    public  function  post(){
        return $this->belongsTo('App\Post'); //反向关联
    }
    //评论所属用户
    public function user(){
        return $this->belongsTo('App\User');
    }
}
