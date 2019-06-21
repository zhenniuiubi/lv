@extends('layout.main')

@section('content')
<div class="col-sm-8 blog-main">
    <div class="blog-post">
        <div style="display:inline-flex">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            @can('update', $post)
            <a style="margin: auto" href="/posts/{{ $post->id }}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            @endcan
            @can('delete', $post)
            <a style="margin: auto" href="/posts/{{ $post->id }}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
            @endcan
        </div>

        <p class="blog-post-meta"{{ $post->created_at }} <a href="#">{{ $post->user->name }}</a></p>

        <p>
            <p>{{ $post->title }}<img
                    src="http://127.0.0.1:8000/storage/72c76b674ec8793fcfd6555ff371bfbd/nxC9ozLfkORmoY92q9lPsejXchVvdNO2cwHiR2Jf.jpeg"
                    alt="图片" style="max-width: 100%;"></p>
            <p>{!! $post->content !!}</p>
        </p>
        <div>
            @if ($post->upvote(\Auth::id())->exists())
                <a href="/posts/{{ $post->id }}/cancelUpvote" type="button" class="btn btn-default btn-lg">取消赞</a>
            @else
                <a href="/posts/{{ $post->id }}/upvote" type="button" class="btn btn-primary btn-lg">赞</a>
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">评论</div>

        <!-- List group -->
        <ul class="list-group">
            @foreach ($post->comments as $comment)
            <li class="list-group-item">
                <h5>{{ $comment->created_at }} by {{ $comment->user->name }}</h5>
                <div>
                    {{ $comment->content }}
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">发表评论</div>

        <!-- List group -->
        <ul class="list-group">
            <form action="/posts/{{ $post->id }}/comment" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <li class="list-group-item">
                    <textarea name="content" class="form-control" rows="10"></textarea>
                    @include('layout.error')
                    <button class="btn btn-default" type="submit">提交</button>
                </li>
            </form>

        </ul>
    </div>

</div><!-- /.blog-main -->
@endsection