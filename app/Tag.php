<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
    	return $this->hasMany('App\Posts');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
