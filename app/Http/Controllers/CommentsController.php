<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        Comment::create($data);

        return redirect()->back()->with('success', 'comment Added Successfuly');
    }

    public function edit(Comment $comment)
    {
        return view('front.comments.edit', compact('comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'updated successfuly');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'comment Deleted Successfuly');
    }

    public function trash()
    {
        $user = Auth::user();
        $comments = Comment::where('user_id', $user->id)->onlyTrashed()->paginate();
        return view('front.dashboard.trashedcomments', compact('comments'));
    }

    public function restore(Request $request, $id)
    {
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->restore();
        return redirect()->back()
            ->with('success', 'Comment restored!');
    }

    public function forceDelete($id)
    {
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->forceDelete();

        return redirect()->route('dashboard.comments')
            ->with('success', 'Comment deleted Forever');
    }
}
