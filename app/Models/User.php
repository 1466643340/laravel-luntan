<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="users";
    public function post()
    {
        return $this->hasMany('App\Models\Post','user_id','id');
    }
    public function reply()
    {
        return $this->hasMany('App\Models\User','user_id','id');
    }
}
