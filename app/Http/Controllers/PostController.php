<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    //
    public function index()
    {
        \DB::connection()->enableQueryLog();  // 开启QueryLog
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        dd(\DB::getQueryLog());
        return view('post/index', compact('posts'));
    }

    //
    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    //显示创建页面
    public function create()
    {
        return view('post/create');
    }

    //保存逻辑
    public function store()
    {
        //验证
        $this->validate(request(),[
            'title'=>'required|string|max:100',
            'content'=>'required|string|min:10',
        ]);
        $res = Post::create((request(['title','content'])));
        return redirect('/posts');
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
