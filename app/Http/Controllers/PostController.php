<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $inputs = request()->validate([
            'title' => 'required | max:50',
            'body' => 'required',
            'post_image' => 'file'
        ]);

        if(request('file'))
        {
            $inputs['post_image'] = request('file')->store('images');
        }

        Auth::user()->posts()->create($inputs);
        Session::flash('message', 'Post created successfully!');

        return redirect()->back();
    }

    public function show(Post $post)
    {
        // $comments = $post->comments;
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('post', 'comments'));
    }
}
