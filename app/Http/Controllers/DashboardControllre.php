<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardControllre extends Controller
{
    public function index()
    {
        return view('front.dashboard');
    }

    public function showPosts(Request $request)
    {
        $user = $request->user();
        $posts = $user->posts;

        return view('front.dashboard.posts', compact('posts'));
    }

    public function showComments(Request $request)
    {
        $user = $request->user();
        $comments = $user->comments;

        return view('front.dashboard.comments', compact('comments'));
    }

}
