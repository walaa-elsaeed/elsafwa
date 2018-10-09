<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    public function news_images()
    {
        return $this->hasmany(new_imgs::class);
    }

    public function news_comments()
    {
        return $this->hasmany(new_comments::class);
    }
}
