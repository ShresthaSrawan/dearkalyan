<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedImage extends Model
{
    const IMAGE_PATH = "images/uploaded/featured-image/";

	protected $fillable = [ 'title', 'slug', 'description', 'is_published' ];

	protected $dates = ['created_at'];

 	protected $casts = [
        'is_published' => 'boolean'
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $this->where('is_published', '1');
    }

    public function scopeNotPublished($query)
    {
        return $this->where('is_published', '0');
    }
}
