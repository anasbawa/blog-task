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
</div>
@endsection
