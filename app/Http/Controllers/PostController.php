<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = [
            ['title' => 'this is title1'],
            ['title' => 'this is title2'],
            ['title' => 'this is title3'],
        ];
        return view('post/index',['posts'=>$posts]);
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
