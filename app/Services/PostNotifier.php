<?php

namespace App\Services;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PostNotifier {

    private $user;
    private $post;

    public function __construct(Post $post, User $user)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function notify()
    {
        $view = "emails.notification";
        $user = $this->post->user;

            $url = url('/post/'.$this->post->id.'/show');
            $data = [
                'title' => 'New notification',
                'content' => 'Hello '. $user->firstName.'!'."\r\n".'Your post has received a new Notification'."\r\n".
                'You can find it here: '.$url
            ];

        Mail::send($view, $data, function($message){

            $post = Post::where('id', $this->post->id)->firstOrFail();
            $user = $post->user->email;
            $message->to($user);
            $message->subject('Someone commented on your post');

        });
    }
}
