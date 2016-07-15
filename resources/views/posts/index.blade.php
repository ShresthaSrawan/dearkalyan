@extends('layouts.master', ['fixedheader' => true])

@section('content')
	<section class="row content-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 single-post-contents">
                @forelse($posts as $post)
                    <article class="single-post-content row m0 post">
                        <header class="row">                        
                            <h5 class="post-meta">
                                <a href="#" class="date">{{ $post->created_at->format('M d, Y') }}</a>
                            </h5>
                            <a href="{{ route('post.show', $post->slug ) }}"><h2 class="post-title">{{ $post->title }}</h2></a>
                            <div class="row">
                                <h5 class="taxonomy pull-left"><i>in</i>
                                @foreach($post->tags as $key => $tag)
    		                        <a href="{{ route('post.index', 'tag='.$tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
    		                    @endforeach
                        	</h5>
                                <div class="response-count pull-right"><img src="{{ asset('images/comment-icon-gray.png') }}" alt="">5</div>
                            </div>
                        </header>
                        <div class="featured-content row m0">
                        	@if($post->isImage())
                            	<img src="{{ $post->image->thumbnail(750,420) }}" alt="">
                            @elseif($post->isGallery())
    	                        <div class="thumbCarousel row m0">
    	                            <div id="slider" class="flexslider">
    	                                <ul class="slides">
    	                                	@foreach($post->images as $image)
    	                                    	<li><img src="{{ $image->thumbnail(750,420) }}" alt=""></li>
    	                                    @endforeach
    	                                </ul>
    	                            </div>
    	                            <div id="carousel" class="flexslider">
    	                                <ul class="slides">
    	                                    @foreach($post->images as $image)
    	                                    	<li><img src="{{ $image->thumbnail(250,140) }}" alt=""></li>
    	                                    @endforeach
    	                                </ul>
    	                            </div>
    	                        </div>
                           	@elseif($post->isVideo())
                           		<div class="embed-responsive embed-responsive-16by9">
    	                            <iframe class="embed-responsive-item" src="{{ $post->video->url }}"></iframe>
    	                        </div>
                            @endif

                        </div>
                        <div class="post-content row">
                            {!! $post->excerpt !!}
                            <p class="text-right"><a href="{{ route('post.show', $post->slug ) }}">Read More</a></p>
                        </div>
                    </article>
                @empty
                    No Posts
                @endforelse
                <div class="pagination">
                    {!! $posts->render() !!}
                </div>
            </div>
            <div class="col-md-4 sidebar">
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
</section>
@stop