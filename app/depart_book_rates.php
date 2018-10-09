<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_book_rates extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depart_book()
    {
        return $this->belongsTo(depart_books::class);
    }
}
