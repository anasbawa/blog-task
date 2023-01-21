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
                    <th scope="col">Title</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $index=>$post )
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                        <td><a href="{{ route('posts.trashed') }}">Trashed Posts</a></td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="3"></th>
                    </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </div>
</div>

@endsection
