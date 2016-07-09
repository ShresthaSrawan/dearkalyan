<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    const ARTICLE = 1, IMAGE = 2, VIDEO = 3, GALLERY = 4;

    public function posts()
    {
    	return $this->hasMany('App\Post', 'type_id');
    }
}
