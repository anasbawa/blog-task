@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @foreach ($posts as $post )
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage/'. $post->image) }}" alt="Card image cap" style="height: 200px">
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">{{ mb_substr($post->content, 0, 25) }} ...</p>
                  <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Show Post</a>
                </div>
              </div>
        </div>
        @endforeach

    </div>
</div>

@endsection
