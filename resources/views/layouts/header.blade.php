<header class="row transparent black header1" id="header">
    <div class="container">
        <div class="row top-header">
            <div class="col-xs-4 search-form-col">
                <form action="#" method="get" class="search-form">
                    <div class="input-group">
                        <span class="input-group-addon"><img src="{{ asset('images/search-icon-white.png') }}" alt=""></span>
                        <input type="search" class="form-control" placeholder="search">
                    </div>
                </form>
            </div>
            <div class="col-xs-4 logo-col text-center">
                <a href="{{ url('/') }}"><img src="{{ asset('images/logo-white.png') }}" alt=""></a>
            </div>
            <div class="col-xs-4 menu-trigger-col">
                <div class="pull-right">
                    <button class="menu-trigger">
                        <span class="active-page">
                            Home
                        </span>
                        <img src="{{ asset('images/menu-align-white.png') }}" alt="" class="icon-burger">
                        <img src="{{ asset('images/menu-close-white.png') }}" alt="" class="icon-cross">
                    </button>
                    @if($user = \Auth::user())
                        <a class="btn" href="#" title="{{ $user->name }}">
                            <i class="fa fa-user fa-2x"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>        
    </div>
    <div class="row menu-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 menu-col">
                    <ul class="nav column-menu black-bg">
                        <li class="active dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.html">Home Option 1</a></li>
                                <li><a href="index2.html">Home Option 2</a></li>
                                <li><a href="index3.html">Home Option 3</a></li>
                                <li><a href="index4.html">Home Option 4</a></li>
                                <li><a href="index5.html">Home Option 5</a></li>
                                <li><a href="index6.html">Home Option 6</a></li>
                            </ul>
                        </li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="#">categories</a></li>
                        <li><a href="#">archives</a></li>
                    </ul>
                    <ul class="nav column-menu black-bg">
                        <li><a href="#">Products</a></li>
                        <li><a href="#">faq</a></li>
                        <li><a href="contact.html">contact</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 subscribe-col">
                    <h5 class="widget-title">subscribe to our newsletter.</h5>
                    <form action="#" method="post" class="form-inline subscribe-form">                    
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><span>send</span></button>
                    </form>
                    <ul class="nav social-nav dark">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>