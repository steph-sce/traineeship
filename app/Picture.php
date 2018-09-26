<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Picture extends Model
{

    protected $fillable = [
        'link',
        'title'
    ];
    public function post() {
        return $this->belongsTo(Post::class);
    }

}