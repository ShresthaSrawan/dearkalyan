<!--Blog Post-->
<article class="col-sm-4 post post-masonry post-format-quote">
    <div class="post-wrapper row">
        <div class="post-excerpt row">
            <h5 class="post-meta">
                <a href="#" class="date">{{ $post->created_at->format('M d, Y') }}</a>
            </h5>
            <h3 class="post-title">{{ $post->title }}</h3>
            <h5 class="quote-maker"><a href="#"></a></h5>
            <footer class="row">
                <h5 class="taxonomy">
                    <i>in</i>
                    @foreach($post->tags as $key => $tag)
                        <a href="{{ route('post.index', 'tag='.$tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
                    @endforeach
                </h5>
                <div class="response-count"><img src="images/comment-icon-white.png" alt="">5</div>
            </footer>
        </div>
    </div>
    @include('posts.options')
</article>