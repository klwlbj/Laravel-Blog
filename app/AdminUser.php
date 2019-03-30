<?php

namespace App;

use \App\Model;
use Illuminate\Foundation\Auth\User as Auth;

class AdminUser extends Auth
{
    protected $guarded=[];//不可注入字段

    protected $rememberTokenName = null;  //不用remembertoken
}
