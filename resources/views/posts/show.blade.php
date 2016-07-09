@extends('layouts.master', ['fixedheader' => true])

@section('content')
	<section class="row content-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 single-post-contents">
                <article class="single-post-content row m0 post">
                    <header class="row">                        
                        <h5 class="post-meta">
                            <a href="#" class="date">{{ $post->created_at->format('M d, Y') }}</a>
                        </h5>
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <div class="row">
                            <h5 class="taxonomy pull-left"><i>in</i>
                            @foreach($post->tags as $key => $tag)
		                        <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
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
                        {!! $post->body !!}
                    </div>
                    <div class="row m0 tags">
	                    @foreach($post->tags as $key => $tag)
	                        <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
	                    @endforeach
                    </div>
                    
                    <ul class="pager">
                    	@if($previous = $post->previous())
	                        <li>
	                            <h4>Previous Articles</h4>
	                            <h2 class="post-title"><a href="{{ route('post.show', $previous->slug) }}">{{ str_limit($previous->title, 100) }}</a></h2>
	                            <h5 class="taxonomy pull-left"><i>in</i>
	                            	 @foreach($post->tags as $key => $tag)
				                        <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
				                    @endforeach
                            	</h5>
	                        </li>
                        @endif
                        @if($next = $post->next())
	                        <li>
	                            <h4>Next Articles</h4>
	                            <h2 class="post-title"><a href="{{ route('post.show', $next->slug) }}">{{ str_limit($next->title, 100) }}</a></h2>
	                            <h5 class="taxonomy pull-left"><i>in</i>
	                            	 @foreach($post->tags as $key => $tag)
				                        <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
				                    @endforeach
                            	</h5>
	                        </li>
                        @endif
                    </ul>
                    
                    <div class="row m0 comments">
                        <h5 class="response-count">5 comments<a href="#comment-form" class="btn btn-primary pull-right"><span>add comment</span></a></h5>
                        <!--Comments-->
                        <div class="media comment">
                            <div class="media-left">
                                <a href="#"><img src="images/posts/c1.jpg" alt="" class="img-circle"></a>
                            </div>
                            <div class="media-body">
                                <h4><a href="#">Mark Sanders</a></h4>
                                <h5><a href="#" class="date">feb 17, 2016 at 3:30pm</a> | <a href="#" class="reply-link">reply</a></h5>
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>                                
                                <!--Comments-->
                                <div class="media comment reply">
                                    <div class="media-left">
                                        <a href="#"><img src="images/posts/c2.jpg" alt="" class="img-circle"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4><a href="#">Mark Sanders</a></h4>
                                        <h5><a href="#" class="date">feb 17, 2016 at 3:30pm</a> | <a href="#" class="reply-link">reply</a></h5>
                                        <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                        <!--Comments-->
                                        <div class="media comment reply">
                                            <div class="media-left">
                                                <a href="#"><img src="images/posts/c1.jpg" alt="" class="img-circle"></a>
                                            </div>
                                            <div class="media-body">
                                                <h4><a href="#">Mark Sanders</a></h4>
                                                <h5><a href="#" class="date">feb 17, 2016 at 3:30pm</a> | <a href="#" class="reply-link">reply</a></h5>
                                                <p>Remaining essentially unchanged.</p>
                                                <!--Comments-->
                                                <div class="media comment reply">
                                                    <div class="media-left">
                                                        <a href="#"><img src="images/posts/c2.jpg" alt="" class="img-circle"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4><a href="#">Mark Sanders</a></h4>
                                                        <h5><a href="#" class="date">feb 17, 2016 at 3:30pm</a> | <a href="#" class="reply-link">reply</a></h5>
                                                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                
                        <!--Comments-->
                        <div class="media comment">
                            <div class="media-left">
                                <a href="#"><img src="images/posts/c1.jpg" alt="" class="img-circle"></a>
                            </div>
                            <div class="media-body">
                                <h4><a href="#">Mark Sanders</a></h4>
                                <h5><a href="#" class="date">feb 17, 2016 at 3:30pm</a> | <a href="#" class="reply-link">reply</a></h5>
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <form action="#" method="post" class="comment-form row" id="comment-form">
                        <h5 class="form-title">leave a reply</h5>
                        <div class="form-group col-sm-6">
                            <label for="name">full name*</label>
                            <input type="text" id="name" class="form-control" placeholder="Your name" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">full name*</label>
                            <input type="email" id="email" class="form-control" placeholder="Your email address here" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="website">website</label>
                            <input type="url" id="website" class="form-control" placeholder="Your website url" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="subject">subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Write subject here" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="message">message</label>
                            <textarea name="message" id="message" class="form-control" placeholder="Write message here"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn-primary"><span>send</span></button>
                            <h5 class="pull-right">*required fields</h5>
                        </div>
                    </form>
                </article>
            </div>
            <div class="col-md-4 sidebar">               
                <!--Author Widget-->
                <aside class="row m0 widget-author widget">
                    @include('posts.author')
                </aside>
                <aside class="row m0 widget-author widget text-left">
                    <h3 class="text-left">Tags</h3>
                    @foreach($tags as $tag)
                        <a href="#" class="tag btn">{{ $tag->name }}</a>
                    @endforeach
                </aside>
                <aside class="row m0 widget-author widget text-left categories">
                    <h3 class="text-left">Categories</h3>
                    <ul>
                        @foreach($postTypes as $category)
                            <li><a href="#" class="">{{ $category->name }} ({{ $category->posts->count() }})</a></li>
                        @endforeach
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</section>

@stop