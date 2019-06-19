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
        // \DB::connection()->enableQueryLog();  // 开启QueryLog
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        // dd(\DB::getQueryLog());
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
        $this->validate(request(), [
            'title'=>'required|string|min:5',
            'content'=>'required|string|min:10',
        ]);
        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']), compact('user_id'));
        
        $post = Post::create($params);
        return redirect('/posts');
    }

    //编辑逻辑
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:5',
        ]);
        //权限
        $this->authorize('update', $post);

        $post->update(request(['title', 'content']));
        return redirect("/posts/$post->id");
    }

    //编辑页面
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    //图片上传
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }

    public function delete(Post $post)
    {
        //权限
        $this->authorize('update', $post);
        $post->delete();
        return redirect('/posts');
    }
}
