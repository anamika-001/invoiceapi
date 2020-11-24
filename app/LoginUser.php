<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginUser extends Model
{
    protected $table = "loginuser";
    protected $fillable = [
        'mobile', 'password','active'
    ];
}
