<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog_article_comments extends Model
{
    public function blog_article()
    {
        return $this->belongsTo(blog_articles::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
