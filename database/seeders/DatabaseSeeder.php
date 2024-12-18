<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * seed the application's database
     */
    public function run()
    {
        // create users with posts and comments
        User::factory(10)->create()->each(function ($user) {
            Post::factory(3)->create(['user_id' => $user->id])->each(function ($post) {
                Comment::factory(2)->create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                ]);
            });
        });

        // create an admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // create regular users
        User::factory(10)->create([
            'role' => 'user',
        ]);
    }
}
