<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_articles extends Model
{
    public function depart()
    {
        return $this->belongsTo(departs::class);
    }

    public function comment()
    {
        return $this->hasMany(depart_articel_comments::class);
    }

    public function article_rate()
    {
        return $this->hasMany(depart_articel_rates::class);
    }
}
