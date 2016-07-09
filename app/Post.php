<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	const IMAGE_PATH = "images/uploaded/post/";

	protected $fillable = [ 'title', 'slug', 'body', 'type_id', 'author_id', 'is_published' ];

    protected $appends = [ 'execerpt' ];

    protected $dates = ['created_at'];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function video()
    {
        return $this->hasOne('App\Video');
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
        return str_limit(strip_tags($this->body), 180);
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

    public function scopeNewest($query)
    {
        return $this->orderBy('created_at', 'desc');
    }

    public function next(){
        return Post::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }
    public  function previous(){
        return Post::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
