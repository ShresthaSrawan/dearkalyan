<div class="white-popup white-popup-image">
	<div class="row">
		<div class="{{ empty($image->description) ? 'col-sm-12' : 'col-sm-8' }}">
			<img src="{{ asset($image->image->path) }}" class="img-responsive">
		</div>
		<div class="{{ empty($image->description) ? 'col-sm-12' : 'col-sm-4' }}">
			<h3>{{ $image->title }}</h3>
			<p>{{ $image->description }}</p>
		</div>
	</div>
</div>