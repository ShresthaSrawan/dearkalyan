<div class="white-popup white-popup-form">
	<header>
		<h3>{{ $type }} Slider Image</h3>
	</header>
	<section>
		@if(isset($slider))
			{{ Form::model($slider, ['route' => ['slider-image.update', $slider->slug], 'method' => 'PUT', 'files' => true]) }}
		@else
			{{ Form::open(['route' => 'slider-image.store', 'method' => 'POST', 'files' => true]) }}
		@endif
			<div class="form-group row">
				<label for="title" class="col-sm-2 form-control-label">Title</label>
				<div class="col-sm-10">
					{{ Form::text('title', old('title'), ['class' => 'form-control', 'required', 'minlength' => 5]) }}
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2">
						Content
					</label>
					<div class="col-sm-10">
						{{ Form::textarea('description',old('description'), ['class' => 'form-control editor']) }}
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2">
						Image
					</label>
					<div class="col-sm-10">
						{{ Form::file('image') }}
						@if(isset($slider) && !is_null($slider->image))
							<img src="{{ $slider->image->thumbnail(64,64) }}">
						@endif
						<p>Must be 1970px x 900px</p>
					</div>
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
	</section>
</div>