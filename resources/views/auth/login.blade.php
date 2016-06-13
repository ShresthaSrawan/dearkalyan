@extends('layouts.master')

@section('body')
    @if(!empty($errors->all()))
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4><i class="fa fa-warning"></i> Warning!</h4>
            <ul class="list-unstyled">
                <?php $dumpErrors = []; ?>
                @foreach($errors->all() as $pos=>$error)
                    @if(!in_array($error,$dumpErrors))
                        <li>{{$error}}</li>
                        <?php $dumpErrors[] = $error; ?>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" role="form" style="text-align:left;" method="POST" action="{{ url('/login') }}"
          autocomplete="off">
        {!! csrf_field() !!}
        <div class="form-group">
            <input type="text" class="form-control" id="login" name="login" required>
            <label for="login">Username/Email</label>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" required>
            <label for="password">Password</label>
            <p class="help-block"><a href="{{ url('/password/reset') }}">Forgot?</a></p>
        </div>
        <br/>
        <div class="row">
            <div class="col-xs-6 text-left">
                <div class="checkbox checkbox-inline checkbox-styled">
                    <label>
                        <input type="checkbox" name="remember"> <span>Remember me</span>
                    </label>
                </div>
            </div><!--end .col -->
            <div class="col-xs-6 text-right">
                <button class="btn btn-primary btn-raised" type="submit">Login</button>
            </div><!--end .col -->
        </div><!--end .row -->
    </form>
@stop