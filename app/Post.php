<?php

namespace App;

use App\Model;

class Post extends Model
{
    // protected $table = 'post';
    protected $fillable = ['title','content'];
}
