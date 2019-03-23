<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy //权限，抽象岀一个类
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //修改权限
    public  function update(User $user,Post $post){
        return $user->id==$post->user_id;
    }
    //删除权限
    public  function delete(User $user,Post $post){
        return $user->id==$post->user_id;
    }
}
