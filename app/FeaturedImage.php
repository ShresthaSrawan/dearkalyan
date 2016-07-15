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

    /**
     * @param array $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(array $options = array())
    {
        if(!is_null($this->image))
        $this->image->delete();
        return parent::delete($options);
    }
}
