<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Upvote;
use App\Comment;

class PostController extends Controller
{
    //
    public function index()
    {
        // \DB::connection()->enableQueryLog();  // 开启QueryLog
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','upvotes'])->paginate(6);
        // dd(\DB::getQueryLog());
        return view('post/index', compact('posts'));
    }

    //
    public function show(Post $post)
    {
        $post->load('comments');
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

    public function comment(Post $post)
    {
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);
        //逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);
        //渲染
        return back();
    }

    //点赞
    public function upvote(Post $post)
    {
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Upvote::firstOrCreate($params);
        return back();
    }

    //取消赞
    public function cancelUpvote(Post $post)
    {
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        //可以在关联关系上使用任何查询构建器！
        $post->upvote(\Auth::id())->delete();
        return back();
    }
}
