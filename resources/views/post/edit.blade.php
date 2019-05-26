@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post </div>

                    <div class="card-body">
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

                        <div class="card-body">

                            <form method="POST" action=" {{ url('/editpost', array($posts->id)) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ $posts->post_title }}" required autocomplete="current-category">

                                        @error('post_title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <label for="post_body" class="col-md-4 col-form-label text-md-right">{{ __('Post Body') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="post_body" type="text" rows="7" class="form-control @error('post_body') is-invalid @enderror" name="post_body"  required autocomplete="current-category">
                                        {{ $posts->post_body }}</textarea>
                                        @error('post_body')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category ') }}</label>

                                    <div class="col-md-6">
                                        <select id="category_id" type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required autocomplete="current-category">
                                            @if(count($categories)>0)
                                                @foreach($categories->all() as $category)
                                                    <option value="{{ $category->id  }}">{{ $category->category }}</option>

                                                @endforeach
                                            @endif

                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Featured Image') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_image" type="file" class="form-control @error('post_image') is-invalid @enderror" name="post_image" required autocomplete="current-category">

                                        @error('post_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Upload Post ') }}
                                        </button>


                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
