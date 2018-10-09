<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_serieses extends Model
{
    public function depart()
    {
        return $this->belongsTo(departs::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(depart_serie_comments::class);
    }

    public function series_rate()
    {
        return $this->hasMany(depart_serie_rates::class);
    }
}
