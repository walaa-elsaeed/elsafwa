<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class new_imgs extends Model
{
    public function news()
    {
        return $this->belongsTo(news::class);
    }
}
