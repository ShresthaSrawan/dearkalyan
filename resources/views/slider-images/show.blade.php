<div class="item post">
    <img src="{{ $slider->image->thumbnail(1970,900) }}" alt="" class="img-responsive main-bg">
    <div class="post-content">
        <div class="container text-right">
            <h5 class="post-meta"><a href="#">{{ $slider->created_at->format('M d, Y') }}</a></h5>
            <h2 class="post-title"><a href="single.html">{{ $slider->title }}</a></h2>
            <a href="single.html" class="btn btn-primary"><span>read more</span></a>
        </div>
    </div>
    @if(\Auth::check())
        @include('slider-images.options', compact('slider'))
    @endif
</div>