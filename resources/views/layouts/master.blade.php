<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--========== The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags ==========-->
<title>@yield('title')</title>

<!--==========Dependency============-->
{{ Html::style('css/bootstrap.min.css') }}
{{ Html::style('css/font-awesome.min.css') }}
{{ Html::style('vendors/owl-carousel/assets/owl.carousel.css') }}
{{ Html::style('vendors/magnific-popup/magnific-popup.css') }}
{{ Html::style('vendors/toastr/toastr.min.css') }}
{{ Html::style('vendors/animate/animate.css') }}
@if(\Auth::check())
  {{ Html::style('vendors/summernote/summernote.css') }}
@endif

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:500">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:600,700italic">
<link href='https://fonts.googleapis.com/css?family=Dosis:400,200,300,500,600,800,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,300,300italic,400italic">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500italic,500,700italic,700,900,900italic' rel='stylesheet' type='text/css'>
<!--==========Theme Styles==========-->
{{ Html::style('css/style.css') }}
{{ Html::style('css/mystyle.css') }}
{{ Html::style('css/theme/green.css') }}

<!--========== HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries ==========-->
<!--========== WARNING: Respond.js doesn't work if you view the page via file:// ==========-->
<!--==========[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]==========-->
</head>
<body class="home">

@if(isset($fixedheader))
    @include('layouts.header2')
@else
    @include('layouts.header')
@endif

@yield('content')

@include('layouts.footer')
<!--========== jQuery (necessary for Bootstrap's JavaScript plugins) ==========-->
{{ Html::script('js/jquery-2.2.0.min.js') }}
{{ Html::script('js/bootstrap.min.js') }}
{{ Html::script('vendors/owl-carousel/owl.carousel.min.js') }}
{{ Html::script('vendors/magnific-popup/jquery.magnific-popup.min.js') }}
{{ Html::script('vendors/instafeed/instafeed.min.js') }}
{{ Html::script('vendors/imagesLoaded/imagesloaded.pkgd.min.js') }}
{{ Html::script('vendors/isotope/isotope.pkgd.min.js') }}
{{ Html::script('vendors/toastr/toastr.min.js') }}
@if(\Auth::check())
  {{ Html::script('vendors/summernote/summernote.min.js') }}
@endif
{{ Html::script('js/theme.js') }}

@yield('script')
<script type="text/javascript">
	@if(Session::has('danger'))
          toastr["danger"]("{!!Session::get('danger')!!}", "danger")
      @elseif(Session::has('info'))
          toastr["info"]("{!!Session::get('info')!!}", "info")
      @elseif(Session::has('warning'))
          toastr["warning"]("{!!Session::get('warning')!!}", "warning")
      @elseif(Session::has('success'))
          toastr["success"]("{!!Session::get('success')!!}", "success")
      @endif

      @if(!empty($errors->all()))
        <?php $dumpErrors = []; ?>
        @foreach($errors->all() as $pos=>$error)
            @if(!in_array($error,$dumpErrors))
                toastr["warning"]("{!! $error !!}", "warning")
                <?php $dumpErrors[] = $error; ?>
            @endif
        @endforeach
	@endif
</script>

</body>
</html>