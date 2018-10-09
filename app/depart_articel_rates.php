<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_articel_rates extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depart_article()
    {
        return $this->belongsTo(depart_articles::class);
    }


}
