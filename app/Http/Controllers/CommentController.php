<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store()
    {
        $comment = new Comment();
        request()->validate(['content' => 'required|max:250']);

        $comment->content = request('content');
        $comment->user()->associate(request()->user());

        $post = Post::where('id', request('post_id'))->firstOrFail();
        $post->comments()->save($comment);

        return response()->json(['result' => $comment]);
    }
}
