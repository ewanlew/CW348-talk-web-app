<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * fillable fields for image (rip)
     */
    protected $fillable = ['path', 'imageable_id', 'imageable_type'];

    /**
     * get the parent imageable model (rip)
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
