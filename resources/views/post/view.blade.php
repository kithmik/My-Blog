@extends('layouts.app')
<style>
    .avatar{

        border-radius:100px ;
        max-width: 100px;
    }
</style>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card">

                <div class="panel-default text-center">
                    @if(session('response'))
                        <div class="alert alert-success" role="alert">
                            {{ (session('response')) }}
                        </div>
                    @endif

                    <div class="card-header">Post View</div>


                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                            <ul class="list-group">
                                @if(count($categories)>0)
                                    @foreach($categories->all() as $category)

                                <li class="list-group-item">
                                <a href="{{ url("category/{$category->id}") }}">{{ $category->category }}</a>
                                </li>
                                    @endforeach
                                @else
                                <p>No Category Found</p>
                                @endif
                            </ul>

                            </div>
                            <div class="col-md-8">

                                @if(count($posts) >0)
                                    @foreach($posts->all() as $post)
                                        <h4>{{ $post->post_title }}</h4>
                                        <img src="{{ $post->post_image }}" alt="" height="200px" width="200px">
                                        <p>{{ ($post->post_body)  }}</p>

                                        <ul class="nav nav-pills">
                                            <li role="presentation">
                                                <a href='{{ url("/like/{$post->id}") }}'><span class="fa fa-thumbs-up">Like {{ $likeCtr }}</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <li role="presentation">
                                                <a href={{ url("/dislike/{$post->id}") }}><span class="fa fa-thumbs-down">Dislike {{ $dislikeCtr }}</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </li>
                                            <li role="presentation">
                                                <a href={{ url("/comment/{$post->id}") }}>
                                                    <span class="fa fa-comment-o">Comment</span>
                                                </a>
                                            </li>
                                        </ul>

                                    @endforeach
                                @else
                                    <p>No posts available</p>
                                @endif

                                    <form method="POST" action='{{ url("/comment/{$post->id}")}}'>
                                    @csrf
                                        <div class="form-group">
                                           <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-lg btn-block">POST COMMENT</button>
                                        </div>
                                    </form>
                                <h3>Comments</h3>
                                    @if(count($comments) >0)
                                        @foreach($comments->all() as $comment)
                                            <p>{{ $comment->comment }}</p>
                                            <p>Posted By: {{ $comment->name }}</p>

                                        @endforeach
                                    @else
                                        <p>No posts available</p>
                                    @endif

                            </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
