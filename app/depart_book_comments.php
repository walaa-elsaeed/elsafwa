<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_book_comments extends Model
{
    public function depart_book()
    {
        return $this->belongsTo(depart_books::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
