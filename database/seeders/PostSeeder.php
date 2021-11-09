<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => "Test Post",
            'body' => "Lorem ipsum.. whatever tf it was",
            'post_image' => null,
            'user_id' => 1,
        ]);
    }
}
