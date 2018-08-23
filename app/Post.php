<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $casts = [
        'start_date' => 'datetime:d-m-Y',
        'end_date' => 'datetime:d-m-Y'
    ];
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function picture() {
        return $this->hasOne(Picture::class);
    }

    public function scopeClosest($query) {
        return $query->where('start_date', '>', (new \DateTime())->format('Y-m-d H:i:s'))->orderBy('start_date', 'ASC');
    }

    public function scopePublished($query) {
        return $query->where('status', '=', 'published');
    }
}
