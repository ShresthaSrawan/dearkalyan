<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Http\Requests;
use App\FeaturedImage;
use App\Http\Requests\CreateFeaturedImageRequest;
use App\Http\Requests\UpdateFeaturedImageRequest;

class FeaturedImageController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function create()
    {
        $type = "Create";
        return view('featured-images.form', compact('type'));
    }

    public function store(CreateFeaturedImageRequest $request)
    {
        DB::transaction(function() use ($request) {
            $inputs = $request->all();
            $inputs['slug'] = str_slug($inputs['title']);
            $featuredImage = FeaturedImage::create($inputs);
            $featuredImage->image()->create([])->setPath($request->file('image'));
        });
        return redirect()->back()->withSuccess('Picture added!');
    }

    public function show(FeaturedImage $image)
    {
        return view('featured-images.show', compact('image'));
    }

    public function edit(FeaturedImage $post)
    {
        $type = 'Edit';
        return view('featured-images.form', compact('post', 'type'));        
    }

    public function update(UpdateFeaturedImageRequest $request, FeaturedImage $post)
    {
        DB::transaction(function() use ($request, $post) {
            $inputs = $request->all();
            $inputs['slug'] = str_slug($inputs['title']);
            $post->update($inputs);
            if($request->hasFile('image')){
                $post->image->delete();
                $post->image()->create([])->setPath($request->file('image'));
            }
        });
        return redirect()->back()->withSuccess('Picture updated!');
    }

    public function publish(FeaturedImage $post)
    {
        if($post->is_published)
        {
            $post->is_published = 0;
            $post->save();
            return redirect()->back()->withSuccess('Image unpublished!');
        } else {
            $post->is_published = 1;
            $post->save();
            return redirect()->back()->withSuccess('Image published!');
        }
    }

    public function destroy(FeaturedImage $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Image deleted!');
    }
}
