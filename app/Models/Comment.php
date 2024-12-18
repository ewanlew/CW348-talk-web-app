<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * fillable fields for comment
     */
    protected $fillable = ['user_id', 'content'];

    /**
     * get the user who owns the comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get the post the comment belongs to
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * get all images associated with the comment (rip didn't do)
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
