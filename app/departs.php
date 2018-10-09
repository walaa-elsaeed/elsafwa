<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departs extends Model
{
    public function depart_series()
    {
        return $this->hasmany(depart_serieses::class);
    }

    public function depart_articles()
    {
        return $this->hasmany(depart_articles::class);
    }

    public function depart_books()
    {
        return $this->hasmany(depart_books::class);
    }


    public function Interested()
    {
        return $this->hasmany(interests::class);
    }


}
