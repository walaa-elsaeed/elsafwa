<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_serie_rates extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depart_series()
    {
        return $this->belongsTo(depart_serieses::class);
    }
}
