@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-8 sign-in">
          <h2 class="text-center h2-text">Sign Up</h2>
          <p class="text-center mt-3">
              Already have an account? <a href="{{ route('login') }}">Sign In</a>
          </p>
          <hr/>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row justify-content-center">
                          <div class="col-md-9">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row justify-content-center">
                          <div class="col-md-9">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row justify-content-center">
                          <div class="col-md-9">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          </div>
                        </div>

                        <div class="form-group row justify-content-center ">
                          <div class="col-md-8 text-center mt-2">
                            <p>
                              By clicking Sign up, I agree to iWander's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>.
                            </p>
                          </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-primary buttons">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection
