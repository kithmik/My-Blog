@extends('layouts.app')
<style>
    .avatar{

        border-radius:100px ;
        max-width: 100px;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

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
