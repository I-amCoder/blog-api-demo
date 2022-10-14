<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'summary', 'content', 'published', 'published_at', 'blog_category_id', 'user_id'];

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}
