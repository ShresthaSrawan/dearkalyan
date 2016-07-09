@if(\Auth::check())
    <div class="slider-options btn-group">
        {{ Form::open(['route'=> ['slider-image.destroy', $slider->slug], 'method' => 'DELETE']) }}
        <a href="{{ route('slider-image.create') }}" class="btn btn-default dyn-modal" title="Add Slider"><i class="fa fa-plus"></i></a>
        <a href="{{ route('slider-image.edit', $slider->slug) }}" class="btn btn-default dyn-modal" title="Edit this Slider"><i class="fa fa-edit"></i></button>
        <a href="{{ route('slider-image.publish', $slider->slug) }}" title="{{ $slider->is_published ? 'Unpublish' : 'Publish' }}" class="btn btn-default"><i class="fa fa-{{ $slider->is_published ? 'eye-slash' : 'eye' }}"></i></a>
        <button type="submit" class="btn btn-default" onclick="return confirm('Delete this post?')" title="Delete this Slider"><i class="fa fa-trash"></i></button>
        {{ Form::close() }}
    </div>
@endif