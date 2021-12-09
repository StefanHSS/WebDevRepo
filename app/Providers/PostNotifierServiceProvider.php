<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Services\PostNotifier;
use Illuminate\Support\ServiceProvider;

class PostNotifierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        app()->singleton(PostNotifier::class, function($app){
            $user = new User();
            $post = new Post();
            return new PostNotifier($post, $user);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
