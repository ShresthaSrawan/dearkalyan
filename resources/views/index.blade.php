@extends('layouts.master')

@section('title', 'Dearkalyan')

@section('content')
    @include('layouts.slider')
    <section class="row content-wrap">
        <div class="container">
            <div class="row" id="post-masonry">
                <aside class="col-sm-4 widget-author widget widget-with-posts post">
                    @include('posts.author')
                </aside>
                @foreach($posts as $post)
                    @include('posts.post-'.$post->type->slug)
                @endforeach
                @if(\Auth::check())
                    <a href="{{ route('post.create') }}" class="btn btn-lg dyn-modal" data-title="Add Article">
                        <article class="col-sm-4 post post-masonry post-format-image">
                            <div class="post-excerpt text-center">
                                <i class="fa fa-plus fa-8x"></i>
                                <h3>Add Articles</h3>
                            </div>
                        </article>
                    </a>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ route('post.index') }}" class="text-lg">See All</a>
                </div>
            </div>
        </div>
    </section>
    <section class="row content-wrap">
        <div class="container">
            <h1>Gallery</h1>
            <div class="grid">
                <div class="grid-sizer"></div>
                <!--Blog Post-->
                @foreach($featuredImages as $post)
                    @include('featured-images.single')
                @endforeach
                @if(\Auth::check())
                    <div class="grid-item">
                        <a href="{{ route('featured-image.create') }}" class="btn btn-lg dyn-modal">
                            <article class="col-sm-4 post post-masonry post-format-image">
                                <div class="post-excerpt text-center">
                                    <i class="fa fa-plus fa-8x"></i>
                                    <h3>Add Pictures</h3>
                                </div>
                            </article>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('layouts.modal')
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $modal = $('#myModal');
            var summernoteOptions = {
                height: 30,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link']],
                    ['table', ['table']],
                    ['options', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            };

            $('.dyn-modal').magnificPopup({
                type: 'ajax',
                removalDelay: 300,
                closeOnBgClick: false,
                mainClass: 'mfp-fade',
                callbacks: {
                    ajaxContentAdded: function () {
                        $('.editor').summernote(summernoteOptions);
                        if ($('.post-types:checked').length > 0)
                            $('.post-types:checked').trigger('change');
                        else
                            $('.post-types').first().trigger('click');
                    }
                }
            });
            $('.dyn-modal').on('mfpOpen', function () {

            });

            $(document).on('change', '.post-types', function () {
                var type = $(this).data('type');
                $('.additional-content').addClass('hidden').find('input').attr('required', false);
                $active = $('.type-' + type + '-field');
                $active.find('input').first().attr('required', true);
                $active.removeClass('hidden');
            });

            // init Isotope
            var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                }
            });
            // layout Isotope after each image loads
            $grid.imagesLoaded().progress(function () {
                $grid.isotope('layout');
            });

            $(".magnific-image").magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            })
        });
    </script>
@stop