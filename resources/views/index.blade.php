@extends('layouts.master')

@section('title', 'Dearkalyan')

@section('content')
	@include('layouts.slider')
	<section class="row content-wrap">
	    <div class="container">
	        <div class="row" id="post-masonry">
	            <!--Author Widget-->
	            <aside class="col-sm-4 widget-author widget widget-with-posts post">
	                <div class="widget-author-inner row">
	                    <div class="author-avatar row"><a href="#"><img src="http://placehold.it/108x108" alt="" class="img-circle"></a></div>
	                    <a href="#"><h2 class="author-name">Mark Sanders</h2></a>
	                    <h5 class="author-title">small title</h5>
	                    <p>The word nature is derived from the Latin word natura, or "essential qualities, innate disposition", and in ancient times, literally meant "birth".</p>
	                    <a href="#" class="know-more">know more</a>
	                </div>
	                <ul class="nav social-nav">
	                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
	                    <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
	                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
	                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
	                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
	                </ul>
	            </aside>
	            <!--Twitter Widget-->
	            <aside class="col-sm-4 widget widget-twitter widget-with-posts post">
	                <div class="widget-twitter-inner">
	                    <h5 class="widget-meta"><i class="fa fa-twitter"></i>Twitter feed <a href="http://twitter.com/chivalricblog">@chivalricblog</a></h5>
	                    <div class="row tweet-texts">
	                        <p>Check out new post on my blog <a href="http://twitter.com/#natureshot">#natureshot</a> <a href="http://bit.ly/blog">http://bit.ly/blog</a></p>
	                    </div>
	                    <div class="row timepast">1 day ago</div>
	                </div>
	            </aside>
	            @foreach($posts as $post)
		            @include('posts.post-'.$post->type->slug)
	            @endforeach
	            @if(\Auth::check())
	            	<a href="#" class="btn btn-lg dyn-modal" data-url="{{ route('post.create') }}" data-title="Add Article">
			            <article class="col-sm-4 post post-masonry post-format-image">
			            	<div class="post-excerpt text-center">
				            	<i class="fa fa-plus fa-8x"></i>
				            	<h3>Add Articles</h3>
		            		</div>
			            </article>
	        		</a>
        		@endif
	            <!--Twitter Widget-->
	            <aside class="col-sm-4 widget widget-instagram widget-with-posts post">
	                <div class="widget-instagram-inner">
	                    <h5 class="widget-meta"><i class="fa fa-twitter"></i>instagram feed <a href="http://twitter.com/chivalricblog">@chivalricblog</a></h5>
	                    <div id="instafeed"></div>
	                </div>
	            </aside>
	        </div>
	    </div>
	</section>

	@include('layouts.modal')
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$modal = $('#myModal');
			
			$(document).on('click', '.dyn-modal', function(e) {
				e.preventDefault();
				$btn = $(this);
				$url = $btn.data('url');
				title = $btn.data('title')
				
				$modal.find('.modal-title').html(title)
				$modal.find('.modal-body').html('Loading...');
				
				$modal.modal();
				
				$.ajax({
					url: $url,
					method: 'GET',
					success: function(response){
						$modal.find('.modal-body').html(response);
						if($('.post-types:checked').length > 0)
							$('.post-types:checked').trigger('change');
						else
							$('.post-types').first().trigger('click');
					}
				});
			});

			$(document).on('change', '.post-types', function (){
				var type = $(this).data('type');
				$('.additional-content').addClass('hidden').find('input').attr('required', false);
				$active = $('.type-' + type + '-field');
				$active.find('input').first().attr('required',true);
				$active.removeClass('hidden');
			});
		});
	</script>
@stop