<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Notifications\EventsNotification;
use App\Services\PostNotifier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

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
            // Nexmo::message()->send([
            //     'to' => '447926334770',
            //     'from' => 'Laravel',
            //     'text' => 'Someone has commented on your Post: ' . $comment->content
            // ]);

            $user = $post->user;
            $url = url('/post/'.$post->id.'/show');
            $data = [
                'title' => 'New notification',
                'content' => 'Hello '. $user->firstName.'!'."\r\n".'Your post has received a new Notification'."\r\n".
                'You can find it here: '.$url
            ];
            if(Auth::user() != $user)
            {
                $notifier = new PostNotifier($post, $user);
                $notifier->notify();
                // Mail::send('emails.notification', $data, function($message){
                //     $post = Post::where('id', request('post'))->firstOrFail();
                //     $user = $post->user->email;

                //     $message->to($user);
                //     $message->subject('Someone commented on your post');

                // });
            }
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

    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);
        $validator = Validator::make(request()->all(), [
            'content' => 'required|max:250',
        ]);

        if(!$validator->fails())
        {
            $comment->content = request('content');
            $comment->user()->associate(request()->user());

            $post = Post::where('id', request('post_id'))->firstOrFail();
            $post->comments()->save($comment);

            Session::flash('success', "Comment updated successfully");
            return back();
        }
        Session::flash('failure', "Comment failed to update");
    }
}
