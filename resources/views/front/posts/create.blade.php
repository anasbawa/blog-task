@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <pre>{{ $errors }}</pre> --}}
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-groupe mb-3">
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" label="Post Title" value="{{ old('title') }}">
                    @error('title')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Post</button>
                    @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
