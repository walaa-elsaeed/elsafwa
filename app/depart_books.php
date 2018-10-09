<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_books extends Model
{
    public function depart()
    {
        return $this->belongsTo(departs::class);
    }

    public function comment()
    {
        return $this->hasMany(depart_book_comments::class);
    }

    public function book_rate()
    {
        return $this->hasMany(depart_book_rates::class);
    }

}
