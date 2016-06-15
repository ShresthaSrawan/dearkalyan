@if(isset($post))
	{{ Form::model($post, ['route' => ['post.update', $post->slug], 'method' => 'PUT', 'files' => true]) }}
@else
	{{ Form::open(['route' => 'post.store', 'method' => 'POST', 'files' => true]) }}
@endif
	<div class="form-group row">
		<label for="title" class="col-sm-2 form-control-label">Title</label>
		<div class="col-sm-10">
			{{ Form::text('title', old('title'), ['class' => 'form-control', 'required', 'minlength' => 5]) }}
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2">Post Type</label>
		<div class="col-sm-10">
			@foreach($postTypes as $type)
				<div class="radio">
					<label>
						{{ Form::radio('type_id', $type->id, isset($post) && $post->type_id == $type->id , ['class' => 'post-types', 'data-type' => $type->slug])}}
						{{ $type->name }}
					</label>
				</div>
			@endforeach
		</div>
	</div>
	<div class="form-group additional-content type-video-field type-gallery-field type-image-field type-article-field type-text-field">
		<div class="row">
			<label class="col-sm-2">
				Content
			</label>
			<div class="col-sm-10">
				{{ Form::textarea('body',old('body'), ['class' => 'form-control']) }}
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row type-image-field hidden additional-content">
			<label class="col-sm-2">
				Image
			</label>
			<div class="col-sm-10">
				{{ Form::file('image') }}
				@if(isset($post) && $post->isImage())
					<img src="{{ $post->image->thumbnail(64,64) }}">
				@endif
			</div>
		</div>
		<div class="row type-gallery-field hidden additional-content">
			<label class="col-sm-2">
				Gallery
			</label>
			<div class="col-sm-10">
				{{ Form::file('images[1][path]') }}
				{{ Form::file('images[2][path]') }}
				{{ Form::file('images[3][path]') }}
				{{ Form::file('images[4][path]') }}
				{{ Form::file('images[5][path]') }}
				@if(isset($post) && $post->isGallery())
					@foreach($post->images as $image)
						<img src="{{ $image->thumbnail(64,64) }}">
					@endforeach
				@endif
			</div>
		</div>
		<div class="row type-video-field hidden additional-content">
			<label class="col-sm-2">
				Video
			</label>
			<div class="col-sm-10">
				@if(isset($post) && $post->isVideo())
					<iframe width="86" height="64" src="{{ $post->video->url }}"></iframe>
				@endif

				{{ Form::text('video[url]', old('video.url'), ['class'=>'form-control']) }}
				<p class="caption">(Embed url)</p>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2">Tags</label>
		<div class="col-sm-10">
			{{ Form::text('tags', isset($post) ? $post->tags->implode('name', ', '):old('tags'), ['class'=>'form-control','required']) }}
			<p class="caption">For multiple tags, use commas(,)</p>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-10 col-sm-offset-2">
			<div class="checkbox">
				<label>
					{{ Form::checkbox('is_published') }} Publish
				</label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12 text-right">
	        <button type="submit" class="btn btn-primary">Save changes</button>
		</div>
	</div>
{{ Form::close() }}