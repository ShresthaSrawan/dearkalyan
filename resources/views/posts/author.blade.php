<!--Author Widget-->
<div class="widget-author-inner row">
    <div class="author-avatar row"><a href="#"><img src="{{ App\User::first()->image->thumbnail(108,108) }}" alt=""
                                                    class="img-circle"></a></div>
    <a href="#"><h2 class="author-name">{{ App\User::first()->name }}</h2></a>
    <h5 class="author-title">{{ App\User::first()->subtitle }}</h5>
    <p>{{ App\User::first()->description }}</p>
    <a href="#" class="know-more">know more</a>
</div>
<ul class="nav social-nav">
    <li><a href="{{ App\User::first()->twitter }}"><i class="fa fa-twitter"></i></a></li>
    <li><a href="{{ App\User::first()->facebook }}"><i class="fa fa-facebook-official"></i></a></li>
    <li><a href="{{ App\User::first()->google }}"><i class="fa fa-google-plus"></i></a></li>
    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
</ul>