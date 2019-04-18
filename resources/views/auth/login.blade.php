@extends('layouts.app')

@section('title', 'login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card login-card">
                <div class="login-header">
                    <h5>Welcome Back!</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter Email Address..">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="customControlAutosizing">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top:10px;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <hr>
                                <div style="text-align:center;">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    <div>
                                        <a href="{{ route('register') }}">Create An Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

@endsection
