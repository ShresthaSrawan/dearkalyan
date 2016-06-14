<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	const IMAGE_PATH = "images/uploaded/post/";

	protected $fillable = [ 'title', 'slug', 'body', 'type_id', 'author_id', 'is_published' ];

    protected $appends = [ 'execerpt' ];

    protected $dates = ['created_at'];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'author_id');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag', 'post_tag');
    }

    public function isArticle()
    {
        return $this->type_id == PostType::ARTICLE;
    }

    public function type()
    {
        return $this->belongsTo('App\PostType');
    }

    public function isImage()
    {
        return $this->type_id == PostType::IMAGE;
    }

    public function isGallery()
    {
        return $this->type_id == PostType::GALLERY;
    }

    public function isVideo()
    {
        return $this->type_id == PostType::VIDEO;
    }

    public function getExcerptAttribute()
    {
        return mb_strimwidth($this->body, 0, 80, "...");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
