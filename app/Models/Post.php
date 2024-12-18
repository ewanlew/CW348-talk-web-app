<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * fillable fields for post
     */
    protected $fillable = ['user_id', 'title', 'content'];

    /**
     * get the user who owns the post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get all comments for the post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * get all images attached to the post
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
