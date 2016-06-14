<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Post;
use App\Tag;
use App\PostType;
use App\Http\Requests;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function create()
    {
    	$postTypes = PostType::all();
    	return view('posts.form', compact('postTypes'));
    }

    public function store(CreatePostRequest $request)
    {
        DB::transaction(function () use ($request) {
            $inputs = $request->all();
            $inputs['slug'] = mb_strimwidth(str_slug($request->get('title')), 0, 32).'-'.time();
            
            $post = $this->user->posts()->create($inputs);

            if( $inputs['type_id'] == PostType::IMAGE )
            {
                $post->image()->create([])->setPath($request->file('image'));
            } elseif( $inputs['type_id'] == PostType::GALLERY )
            {
                foreach ($request->file('gallery') as $image) {
                    if(is_null($image))
                        continue;
                    $post->image()->create([])->setPath($image);
                }

            }
            $tags = explode(',', $request->get('tags'));

            foreach ($tags as $tag) {
                $slug = str_slug($tag);
                $tagExists = Tag::whereSlug($slug)->first();
                
                if(!$tagExists)
                    $tagExists = Tag::create(['name' => $tag, 'slug' => $slug]);

                $post->tags()->save($tagExists);
            }
        });

        return redirect()->back()->withSuccess('Post created!');
    }

    public function show(Post $post)
    {
        dd($post);
    }
}
