<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Post;
use App\Http\Requests;

class FrontController extends Controller
{
    public function index()
    {
    	$posts = Auth::check() ? Post::all() : Post::published()->get();
    	return view('index', compact('posts'));
    }
}
