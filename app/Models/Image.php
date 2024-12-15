<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'title', 'caption', 'category_id', 'blog_id'];  // Adjust based on your schema

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    //
}
