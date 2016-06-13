@extends('auth.master')

@section('title', 'Reset Password')

@section('body')
  <section>
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="card">
              <div class="card-head">
                <header>Reset Password</header>
              </div>
              <form class="form form-validate" role="form" method="POST" action="{{ url('/password/reset') }}" novalidate>
                <div class="card-body">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                      <label>E-Mail Address</label>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password">
                      <label>Password</label>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password_confirmation">
                      <label>Confirm Password</label>
                    </div>
                </div>
                <div class="card-actionbar">
                  <div class="card-actionbar-row">
                    <button type="submit" class="btn btn-flat btn-primary ink-reaction">Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
