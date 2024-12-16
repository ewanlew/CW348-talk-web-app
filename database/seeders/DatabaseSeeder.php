<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            Post::factory(3)->create(['user_id' => $user->id])->each(function ($post) {
                Comment::factory(2)->create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                ]);
            });
        });
    }
}
