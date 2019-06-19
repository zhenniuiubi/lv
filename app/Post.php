<?php

namespace App;

use App\Model;

class Post extends Model
{
    // protected $table = 'post';
    protected $fillable = ['title','content'];
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
