@if(\Auth::check())
    <div class="post-options btn-group">
        {{ Form::open(['route'=> ['post.destroy', $post->slug], 'method' => 'DELETE']) }}
        <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-default dyn-modal"><i class="fa fa-edit"></i></button>
        <a href="{{ route('post.publish', $post->slug) }}" title="{{ $post->is_published ? 'Unpublish' : 'Publish' }}" class="btn btn-default"><i class="fa fa-{{ $post->is_published ? 'eye-slash' : 'eye' }}"></i></a>
        <button type="submit" class="btn btn-default" onclick="return confirm('Delete this post?')"><i class="fa fa-trash"></i></button>
        {{ Form::close() }}
    </div>
@endif