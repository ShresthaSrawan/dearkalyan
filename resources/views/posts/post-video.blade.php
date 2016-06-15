<!--Blog Post-->
<article class="col-sm-4 post post-masonry post-format-{{ $post->type->slug }}">
    <div class="post-wrapper row">
    	@if($post->isVideo() && !is_null($post->video))
            <div class="featured-content row">
                <iframe width="360" height="203" src="{{ $post->video->url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif
        <div class="post-excerpt row">
            <h5 class="post-meta">
                <a href="#" class="date">{{ $post->created_at->format('M d, Y') }}</a>
            </h5>
            <h3 class="post-title"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
            <p>{{ $post->excerpt }}</p>
            <footer class="row">
                <h5 class="taxonomy">
                	<i>in</i>
                	@foreach($post->tags as $key => $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
                    @endforeach
                </h5>
                <div class="response-count"><img src="images/comment-icon-gray.png" alt="">5</div>
            </footer>
        </div>
    </div>
    @include('posts.options')
</article>