<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class new_comments extends Model
{
    public function news()
    {
        return $this->belongsTo(news::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
