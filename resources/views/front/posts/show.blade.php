@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <img src="{{ asset('storage/'. $post->image) }}" class="img-fluid" alt="Responsive image">
    </div>
    <hr>
    <div class="row mt-3">
        <div class="col-md-8">
            <h3>{{ $post->title }}</h3>
            <h5>{{ $post->content }}</h5>
        </div>
        <div class="col-md-4">
            <div class="card border-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">by: {{ $post->user->name }}</div>
                <div class="card-body text-secondary">
                  <p class="card-text">created: {{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @auth
            @if (Auth::id() == $post->id)
            <div class="card border-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">Operations</div>
                <div class="card-body text-secondary">
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Archive</button>
                    </form>

                    <a href="{{ route('posts.edit', $post->id) }}" type="button" class="btn btn-secondary btn-sm">Edit</a>
                </div>
            </div>
            @endif
            @endauth
        </div>

    </div>

    <section>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <h3>{{ $comments->count() }} Comments</h3>
        @forelse ($comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">{{ $comment->comment }}</p>
                <div class="text-muted mb-4">
                    {{ $comment->created_at->diffForHumans() }},
                    By: {{ $comment->user->name }}
                </div>
            </div>
        </div>
        @auth
        @if (Auth::id() === $comment->user_id)
        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-lg d-inline">Delete</button>
        </form>
        <a href="{{ route('comments.edit', $comment->id) }}" type="button" class="btn btn-secondary btn-lg d-inline">Edit</a>
        @endif
        @endauth
        @empty
        <div class="mb-3">
            <p class="">No comments!</p>
        </div>
        @endforelse
        @auth
        <hr>
        <h4>Add Your Comment</h4>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group mb-3">
                <div>
                    <textarea class="form-control @error('comment') is-invalid @enderror" rows="6" name="comment">{{ old('comment') }}</textarea>
                    @error('comment')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </div>
        </form>
        @endauth
        @guest
        <a href="{{ route('login') }}">Login to comment!</a>
        @endguest
    </section>
</div>
@endsection
