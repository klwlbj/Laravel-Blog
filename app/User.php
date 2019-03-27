<?php

namespace App;
use \App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //用户的文章列表
    function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }
    //关注我的粉丝模型，获取所有关注
    function fans(){
        return $this->hasMany(\App\Fan::class,'star_id','id');

    }
    //我关注的粉丝模型,获取所有粉丝
    function stars(){
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }
    //关注某人
    function doFan($uid){
        $fan = new \App\Fan();
        $fan->star_id =$uid;
        return $this->stars()->save($fan);
    }
    //不关注某人
    function doUnFan($uid){
        $fan = new \App\Fan();
        $fan->star_id =$uid;
        return $this->stars()->delete($fan);
    }
    //返回是否粉丝了
    function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }
    //返回是否关注了
    function hasStar($uid){
        return $this->fans()->where('fan_id', $uid)->count();
    }
}
