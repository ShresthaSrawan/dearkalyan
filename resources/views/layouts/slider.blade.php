<section class="row featured-post-carousel">
    @forelse($sliderImages as $slider)
        @include('slider-images.show', compact('slider'))
    @empty
        <div class="item post">
            <img src="{{ asset('images/uploaded/banner/img1.jpg') }}" alt="" class="img-responsive main-bg">
            <div class="post-content">
                <div class="container text-right">
                    <h5 class="post-meta"><i>in</i> <a href="#">Author Profile</a> | <a href="#">feb 17, 2016</a></h5>
                    <h2 class="post-title"><a href="single.html">single</a></h2>
                    <a href="single.html" class="btn btn-primary"><span>read more</span></a>
                </div>
            </div>
            @if(\Auth::check())
                <div class="slider-options btn-group">
                    <a href="{{ route('slider-image.create') }}" class="btn btn-default dyn-modal"><i class="fa fa-plus"></i></a>
                </div>
            @endif
        </div>
    @endforelse
</section>