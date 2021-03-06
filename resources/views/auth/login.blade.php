@extends('layouts.app')

@section('pageTitle', 'Log In')

@push('scripts')
<script>
  {{-- work around to push and run after jQuery is loaded since --}}
  window.addEventListener('DOMContentLoaded', function() {
    (function($) {
      $('form#login').submit(function(){
          $(this).find(':button#submit').prop('disabled', true);
      });
    })(jQuery);
  });
</script>
@endpush

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card card-auth">
        <div class="card-body">
          <svg version="1.1" x="0px" y="0px" width="75" height="75" viewBox="0 0 220 220" enable-background="new 0 0 223.489 220.489" id="logo" style="fill: #195905;">
            <path id="logo-path" d="m 187.42396,32.576354 c -42.87821,-42.874396 -112.393767,-42.874396 -155.264347,0 -42.879484,42.878211 -42.879484,112.391236 0,155.266896 42.87058,42.87567 112.389957,42.87567 155.264347,0 42.87567,-42.87566 42.87567,-112.388685 0,-155.266896 z m -34.95429,114.891786 -25.04366,-25.03984 7.87686,-7.87687 -4.16546,-4.1642 -21.17074,21.17201 4.16037,4.16801 8.15287,-8.15668 25.05002,25.04113 -37.53878,37.53878 -25.046204,-25.04239 4.272304,-4.26849 -29.852708,-29.85653 -4.277392,4.27358 -25.039847,-25.04366 37.540057,-37.540065 25.041119,25.041119 -8.157951,8.155416 5.127019,5.12575 21.177093,-21.17329 -5.12448,-5.125747 -7.881947,7.880677 -25.042386,-25.043663 37.266593,-37.260239 25.0373,25.041119 -4.26721,4.273576 29.85144,29.853979 4.27485,-4.273576 25.04111,25.044944 z"></path>
          </svg>

          <h4>Login</h4>

          <form id="login" role="form" method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="form-group">
              <input id="login" type="text" name="login" value="{{ old('login') }}" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" placeholder="Email address or Username" required autofocus autocomplete="username">
              @if ($errors->has('login'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('login') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required autocomplete="current-password">
              @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>

            <button id="submit" class="btn btn-lg btn-info btn-block" type="submit">Sign in</button>
          </form>
          <br>
          <a href="{{ route('password.request') }}" class="text-info mt-2">
            Forgot your password?
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
