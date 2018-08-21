<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function picture() {
        return $this->hasOne(Picture::class);
    }
}
