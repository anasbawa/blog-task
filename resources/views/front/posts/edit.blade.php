@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <pre>{{ $errors }}</pre>
            <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-groupe mb-3">
                    <input class="form-control" type="text" value="{{ $post->title }}" name="title" label="Post Title">
                </div>
                <div class="form-group mb-3">
                    <textarea class="form-control"name="content">{{ $post->content }}</textarea>
                </div>
                @if ($post->image)
                <img src="{{ asset('storage/'. $post->image) }}" alt="..." class="img-thumbnail">
                @endif
                <div class="form-group mb-3">
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
