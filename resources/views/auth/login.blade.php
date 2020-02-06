@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 sign-in">
            <h2 class="text-center h2-text">Sign In</h2>
            <p class="text-center mt-3">
                Don't have an account yet? <a href="{{ route('register') }}">Sign Up</a>
            </p>
            <hr/>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row justify-content-center">
                  <div class="col-md-9">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row justify-content-center">
                  <div class="col-md-9">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-5">
                        <div class="form-check">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group row mb-0 justify-content-center">
                    <div class="col-md-8 text-center">
                        <button type="submit" class="btn btn-primary buttons">
                            {{ __('SIGN IN') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
