<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * determine if the user can update the post
     */
    public function update(User $user, Post $post)
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    /**
     * determine if the user can delete the post
     */
    public function delete(User $user, Post $post)
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }
}
