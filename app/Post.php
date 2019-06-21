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
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    //评论模型
    public function comments()
    {
        return $this->hasMany(\App\Comment::class, 'post_id', 'id')->orderBy('created_at', 'desc');
    }

    //和用户关联
    public function upvote($user_id)
    {
        return $this->hasOne(\App\Upvote::class, 'post_id', 'id')->where('user_id', $user_id);
    }

    //文章的所有章
    public function upvotes()
    {
        return $this->hasMany(\App\Upvote::class);
    }
}
