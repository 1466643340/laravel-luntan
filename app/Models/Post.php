<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function  reply()
    {
        return $this->hasMany('App\Models\Reply','posts_id','id');
    }
}
