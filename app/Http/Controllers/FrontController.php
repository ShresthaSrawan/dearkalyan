<?php

namespace App\Http\Controllers;

use App\SliderImage;
use Illuminate\Http\Request;

use App\Post;
use App\FeaturedImage;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
    	$posts = Auth::check() ? Post::newest()->get() : Post::published()->newest()->get();
    	$featuredImages = Auth::check() ? FeaturedImage::all() : FeaturedImage::published()->get();
    	$sliderImages = Auth::check() ? SliderImage::all() : SliderImage::published()->get();
    	return view('index', compact('posts', 'featuredImages', 'sliderImages'));
    }
}
