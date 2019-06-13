<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index()
    {
        return view('post/index');
    }

    //
    public function show()
    {
        return view('post/show',['title'=>'this is title','isShow'=>false]);
    }

    //
    public function create()
    {
        return view('post/create');
    }

    //编辑
    public function store()
    {
    }

    //编辑逻辑
    public function update()
    {
    }

    //删除逻辑
    public function edit()
    {
        return view('post/edit');
    }
}
