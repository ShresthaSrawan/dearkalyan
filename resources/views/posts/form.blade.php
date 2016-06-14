{{ Form::open(['route' => 'post.store', 'method' => 'POST', 'files' => true]) }}
	<div class="form-group row">
		<label for="title" class="col-sm-2 form-control-label">Title</label>
		<div class="col-sm-10">
			{{ Form::text('title', null, ['class' => 'form-control', 'required', 'minlength' => 5]) }}
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2">Post Type</label>
		<div class="col-sm-10">
			@foreach($postTypes as $type)
				<div class="radio">
					<label>
						{{ Form::radio('type_id', $type->id, $type->id==1, ['class' => 'post-types', 'data-type' => $type->slug])}}
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
				{{ Form::textarea('body',null, ['class' => 'form-control']) }}
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
			</div>
		</div>
		<div class="row type-gallery-field hidden additional-content">
			<label class="col-sm-2">
				Gallery
			</label>
			<div class="col-sm-10">
				{{ Form::file('gallery[]') }}
				{{ Form::file('gallery[]') }}
				{{ Form::file('gallery[]') }}
				{{ Form::file('gallery[]') }}
				{{ Form::file('gallery[]') }}
			</div>
		</div>
		<div class="row type-video-field hidden additional-content">
			<label class="col-sm-2">
				Video
			</label>
			<div class="col-sm-10">
				{{ Form::file('video') }}
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2">Tags</label>
		<div class="col-sm-10">
			{{ Form::text('tags', null, ['class'=>'form-control','required']) }}
			<p class="caption">For multiple tags, use commas(,)</p>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-10 col-sm-offset-2">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="is_published"> Publish
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