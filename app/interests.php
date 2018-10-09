<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class interests extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depart()
    {
        return $this->belongsTo(departs::class);
    }
}
