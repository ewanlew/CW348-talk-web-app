<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed users, each with 3 posts and each post with 2 comments
        User::factory(10)->create()->each(function ($user) {
            $posts = Post::factory(3)->create(['user_id' => $user->id]);
            $posts->each(function ($post) {
                Comment::factory(2)->create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                ]);
            });
        });
    }
}
