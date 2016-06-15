<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['post_id','url'];

    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
