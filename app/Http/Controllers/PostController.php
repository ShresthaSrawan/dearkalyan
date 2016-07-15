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

    public function index(Request $request)
    {
        $posts = Post::newest();

        if($request->has('tag')) {
            $tag = $request->get('tag');
            $posts->whereHas('tags', function($query) use($tag) {
                $query->where('slug', $tag);
            });
        }

        if($request->has('category')) {
            $category = PostType::whereSlug($request->get('category'))->first();
            $posts->where('type_id',  $category->id);
        }

        $posts = $posts->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $postTypes = PostType::all();
        $type = 'Create';
        return view('posts.form', compact('postTypes', 'type'));
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
            }
            elseif( $inputs['type_id'] == PostType::GALLERY )
            {
                for ($i=1;$i<=5;$i++) {
                    $image = $request->file("images.$i.path");
                    if(is_null($image))
                        continue;
                    $post->image()->create([])->setPath($image);
                }

            }
            elseif( $inputs['type_id'] == PostType::VIDEO )
            {
                $post->video()->create(['url'=>$request->get('video.url')]);
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
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
    	$postTypes = PostType::all();
        $type = 'Edit';
        return view('posts.form', compact('postTypes', 'post', 'type'))->render();
    }

    public function update(Request $request, Post $post)
    {
        DB::transaction(function () use ($request, $post) {
            $inputs = $request->all();
            $inputs['slug'] = mb_strimwidth(str_slug($request->get('title')), 0, 32).'-'.time();
            
            $post->update($inputs);

            if( $inputs['type_id'] == PostType::IMAGE )
            {
                if($request->file('image')) {
                    if(!is_null($post->image))
                        $post->image->delete();
                    $post->image()->create([])->setPath($request->file('image'));
                }
            }
            elseif( $inputs['type_id'] == PostType::GALLERY )
            {
                if(! $post->images->isEmpty() )
                    $post->images()->delete();
                for ($i=1;$i<=5;$i++) {
                    $image = $request->file("images.$i.path");
                    if(is_null($image))
                        continue;
                    $post->image()->create([])->setPath($image);
                }

            }
            elseif( $inputs['type_id'] == PostType::VIDEO )
            {
                if(!is_null($post->video))
                    $post->video->delete();
                $post->video()->create(['url'=>$request->get('video.url')]);
            }
            $tags = explode(',', $request->get('tags'));

            $post->tags()->delete();
            
            foreach ($tags as $tag) {
                $slug = str_slug($tag);
                $tagExists = Tag::whereSlug($slug)->first();
                
                if(!$tagExists)
                    $tagExists = Tag::create(['name' => $tag, 'slug' => $slug]);

                $post->tags()->save($tagExists);
            }
        });

        return redirect()->back()->withSuccess('Post updated!');
    }

    public function publish(Post $post)
    {
        if($post->is_published)
        {
            $post->is_published = 0;
            $post->save();
            return redirect()->back()->withSuccess('Post unpublished!');
        } else {
            $post->is_published = 1;
            $post->save();
            return redirect()->back()->withSuccess('Post published!');
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Post deleted!');
    }
}
