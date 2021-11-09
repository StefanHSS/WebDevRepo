<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'content' => 'required|max:250',
        ]);

        if(!$validator->fails())
        {
            $comment = new Comment();
            $comment->content = request('content');
            $comment->user()->associate(request()->user());

            $post = Post::where('id', request('post'))->firstOrFail();
            $post->comments()->save($comment);

            //return response()->json(['result' => $comment]);
            return $comment;
        }

        return response()->json(['result' => $validator->errors()]);
    }
}
