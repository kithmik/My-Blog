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
            <div class="card shadow">
                <div class="panel-default text-center">
                @if (count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ ('$error') }}
                        </div>
                    @endforeach

                @endif
                @if(session('response'))
                    <div class="alert alert-success" role="alert">
                        {{ (session('response')) }}
                    </div>
                @endif
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">Dashboard</div>
                        <div class="col-md-8">
                            <form method="POST" action='{{ url("/search")}}'>
                                @csrf
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="search for....">
                                <span class="input-group btn">
                                    <button type="submit" class="btn btn-default">Go!</button>
                                </span>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                    <div class="col-md-4">
                        @if(!empty($profile))
                            <img src="{{ $profile->profile_pic }}" class="avatar" alt="">


                        @else
                            <img src="{{ url('images/7yPTUn1.jpg') }}" class="avatar" alt="">

                        @endif

                            @if(!empty($profile))
                                <p class="lead">{{ $profile->name }}</p>

                            @else
                                <p></p>
                            @endif

                            @if(!empty($profile))
                                <p class="lead">{{ $profile->designation }}</p>

                            @else
                                <p></p>
                            @endif

                    </div>
                    <div class="col-md-8">
                        @if(count($posts) >0)
                            @foreach($posts->all() as $post)
                            <div class="card shadow">

                            <h4>{{ $post->post_title }}</h4>
                                <img src="{{ $post->post_image }}" alt="" height="200px" width="200px">
                                <p>{{ substr($post->post_body, 0,150)  }}</p>

                            <ul class="nav nav-pills">
                                <li role="presentation">
                                    <a href='{{ url("/view/{$post->id}") }}'><span class="fa fa-eye">View</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </li>
                                @if(auth()->id() == '1')

                                <li role="presentation">
                                    <a href={{ url("/edit/{$post->id}") }}><span class="fa fa-edit">Edit</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </li>
                                <li role="presentation">
                                    <a href={{ url("/delete/{$post->id}") }}>
                                        <span class="fa fa-trash">Delete</span>
                                    </a>
                                </li>
                                    @endif
                            </ul>
                            <cite style="">Posted on: {{ date('M j,Y H:i', strtotime($post->updated_at)) }}</cite>

                            </div>
                                
                                <hr>
                            @endforeach
                            @else
                                <p>No posts available</p>
                        @endif

                        {{ $posts-> links()}}
                    </div>
                    </div>
                </div>
                </div>
                </div>
             </div>
         </div>
     </div>
</div>
@endsection
