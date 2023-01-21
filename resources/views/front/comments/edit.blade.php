@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-groupe mb-3">
                            <input class="form-control" value="{{ $comment->comment }}" type="text" name="comment" label="Post Title">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Comment</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
