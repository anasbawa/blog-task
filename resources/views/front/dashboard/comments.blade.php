@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="nav">
            <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-link active" href="{{ route('dashboard.posts') }}">My Posts</a>
            <a class="nav-link" href="{{ route('dashboard.comments') }}">My Comments</a>
          </nav>
        <div class="col-md-4">

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Post</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($comments as $index=>$comment )
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <th scope="row">{{$comment->comment }}</th>
                        <td><a href="{{ route('posts.show', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                        <td><a href="{{ route('comments.trashed') }}">Trashed comments</a></td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="3">There is no comments</th>
                    </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </div>
</div>

@endsection
