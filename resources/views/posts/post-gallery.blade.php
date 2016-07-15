<!--Blog Post-->
<article class="col-sm-4 post post-masonry post-format-gallery">
    <div class="post-wrapper row">
        <div class="featured-content row">
            <div class="gallery-of-post">
                @if($post->isGallery() && !$post->images->isEmpty())
                    @foreach($post->images as $image)
                        <a href="{{ route('post.show', $post->slug) }}">
                            <div class="item"><img src="{{ $image->thumbnail(360,203) }}" alt=""></div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
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
                        <a href="{{ route('post.index', 'tag='.$tag->slug) }}">{{ $tag->name }}</a>{{ $post->tags->count() > 1 && ($post->tags->count() - 1) != $key ? ',' : '' }}
                    @endforeach
                </h5>
                <div class="response-count"><img src="images/comment-icon-gray.png" alt="">5</div>
            </footer>
        </div>
    </div>
    @include('posts.options')
</article>