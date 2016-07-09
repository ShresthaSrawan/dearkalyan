<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    const IMAGE_PATH = "images/uploaded/slider/";

    protected $fillable = ['title', 'slug', 'link', 'description', 'order', 'is_published'];

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
