<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
//表 => posts
class Model extends BaseModel
{
    protected $guarded=[];//不可注入字段
//    protected $fillable=['tilte','content'];//可注入字段
    //
}
