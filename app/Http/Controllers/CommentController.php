<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
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
            Nexmo::message()->send([
                'to' => '447926334770',
                'from' => 'Laravel',
                'text' => 'Someone has commented on your Post: ' . $comment->content
            ]);
            return $comment;
        }

        return response()->json(['result' => $validator->errors()]);
    }

    public function replyStore()
    {

        $validator = Validator::make(request()->all(), [
            'content' => 'required|max:250',
        ]);

        if(!$validator->fails())
        {
            $reply = new Comment();
            $reply->content = request('content');
            $reply->user()->associate(request()->user());
            $reply->parent_id = request('comment_id');

            $post = Post::where('id', request('post_id'))->firstOrFail();
            $post->comments()->save($reply);

            return $reply;
        }
        return response()->json(['result' => $validator->errors()]);
    }
}
