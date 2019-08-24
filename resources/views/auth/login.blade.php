@extends('auth.index')

@section('content')
<div class="login-box card">
  <div class="card-body">
    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
      @csrf
      <a href="javascript:void(0)" class="text-center db"><img src="plugins/assets/images/logo-icon.png" alt="Home" /><br/><img src="plugins/assets/images/logo-text.png" alt="Home" /></a>
      <div class="form-group m-t-40">
        <div class="col-xs-12">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Логин" autofocus>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-12">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Пароль">
        </div>
      </div>
      <div class="form-group">
        <div class="d-flex no-block align-items-center">
          <div class="checkbox checkbox-primary p-t-0">
            <input id="checkbox-signup" type="checkbox">
            <label for="checkbox-signup"> Remember me </label>
          </div>
          <div class="ml-auto">
            @if (Route::has('password.request'))
              <a class="btn btn-link" id="to-recover" class="text-muted" href="{{ route('password.request') }}">
                <i class="fa fa-lock m-r-5"></i> {{ __('Забыли пароль?') }}
              </a>
            @endif
          </div>
        </div>
      </div>
      <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
            {{ __('Войти') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
