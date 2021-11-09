<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create()->each(function ($user) {
        //      $user->posts()->saveMany(\App\Models\Post::factory(3)->make());
        //  });

        //Shorter version of the code above. Both versions work, hence top one is commented out
        \App\Models\User::factory(10)->has(
            \App\Models\Post::factory(3))->create();

        // \App\Models\User::factory(10)->has(
        //     \App\Models\Post::factory(3)->has(
        //         \App\Models\Comment::factory(3)))->create();

    //     $users = [

    //         ['firstName' => "Stefan",
    //         'lastName' => "Hristov",
    //         'email' => "sky@gmail.com",
    //         'avatar' => null,
    //         'email_verified_at' => now(),
    //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    //         'remember_token' => Str::random(10)],
    // ];

    // foreach($users as $user)
    // {
    //     User::create($user);
    // }

     }
}
