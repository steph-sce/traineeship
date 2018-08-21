<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function post() {
        return $this->belongsTo(Book::class);
    }
}
