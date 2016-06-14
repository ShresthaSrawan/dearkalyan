<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\Http\Requests;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
    	dd($tag);
    }
}
