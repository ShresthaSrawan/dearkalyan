@extends('auth.master')

@section('title', 'Reset Email')

@section('body')
  <section>
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="card">
              <div class="card-head"><header>Reset Password</header></div>
              <form class="form form-validate" role="form" method="POST" action="{{ url('/password/email') }}">
                <div class="card-body">
                  @if (session('status'))
                    <div class="alert alert-success">
                      {{ session('status') }}
                    </div>
                  @endif
                  @include('auth.errors')
                  {!! csrf_field() !!}
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    <label>E-Mail Address</label>
                  </div>
                </div>
                <div class="card-actionbar">
                  <div class="card-actionbar-row">
                    <button type="submit" class="btn btn-flat btn-primary ink-reaction">Send</button>
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
