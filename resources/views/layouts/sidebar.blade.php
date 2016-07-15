<!--Author Widget-->
<aside class="row m0 widget-author widget">
    @include('posts.author')
</aside>
<aside class="row m0 widget-author widget text-left">
    <h3 class="text-left">Tags</h3>
    @foreach(App\Tag::all() as $tag)
        <a href="{{ route('post.index', 'tag='.$tag->slug) }}" class="tag btn">{{ $tag->name }}</a>
    @endforeach
</aside>
<aside class="row m0 widget-author widget text-left categories">
    <h3 class="text-left">Categories</h3>
    <ul>
        @foreach(App\PostType::all() as $category)
            <li><a href="{{ route('post.index', 'category='.$category->slug) }}" class="">{{ $category->name }} ({{ $category->posts->count() }})</a></li>
        @endforeach
    </ul>
</aside>