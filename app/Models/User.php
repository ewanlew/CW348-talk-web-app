<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * fillable fields for user
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * hidden fields for arrays
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * cast fields to specific types
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * get all posts by the user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * get all comments by the user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * check if the user is an admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
