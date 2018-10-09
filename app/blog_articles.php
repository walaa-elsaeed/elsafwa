<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog_articles extends Model
{
    public function blog()
    {
        return $this->belongsTo(blogs::class);
    }

    public function comment()
    {
        return $this->hasmany(blog_article_comments::class);
    }
}
