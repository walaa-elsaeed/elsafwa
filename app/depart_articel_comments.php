<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depart_articel_comments extends Model
{
    public function depart_article()
    {
        return $this->belongsTo(depart_articles::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
