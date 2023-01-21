<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::all();
        return view('front.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('front.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post Creaetd Successfuly');
    }

    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('front.posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        return view('front.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $old_image = $post->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        $post->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('posts.index')->with('success', 'Updated Successfuly');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Deleted Successfuly');
    }

    public function trash()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->onlyTrashed()->paginate();
        return view('front.dashboard.trashedposts', compact('posts'));
    }

    public function restore(Request $request, $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->back()
            ->with('success', 'Post restored!');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted Forever');
    }

    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')){
            return;
        }

            $file = $request->file('image'); // Uploaded File object
            $path = $file->store('uploads', [
                'disk' => 'public'
            ]);
            return $path;

    }
}
