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
        if($post->comments())
        {
            $comments = $post->comments()->orderBy('created_at', 'desc')->get();
            return view('posts.index', compact('post', 'comments'));
        }
        return view('posts.index', compact('post'));
    }

    public function destroy(Post $post)
    {
        //Because relationship is polymorphic, SQL does not understand Laravel Polymorphism
        // so when deleting a polymorphic object, one must be explicit as to delete the respective
        //children of the relationship 1st !!!
        $post->comments()->delete();
        $post->delete();

      return redirect()->back();
    }

    public function update(Post $post)
    {
        //some update logic here
    }
}
