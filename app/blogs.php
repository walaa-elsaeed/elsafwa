<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    public function blog_article()
    {
        return $this->hasmany(blog_articles::class);
    }

}
