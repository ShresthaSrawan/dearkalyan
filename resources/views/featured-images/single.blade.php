<div class="grid-item">
	<div class="box">
		<a class="dyn-modal" href="{{ route('featured-image.show', $post->slug) }}" title="{{ $post->title }}">
			<img src="{{ $post->image->resize(400) }}" alt="" />
			<span class="caption scale-caption">
			    <h5>{{ mb_strimwidth($post->title, 0, 60, "...") }}</h5>
		    </span>
	    </a>
    </div>
    @include('featured-images.options')
</div>