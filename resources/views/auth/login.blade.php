@extends('layouts.frame_guest')

@section('pagetitle', __('Login'))
@section('bodyid', 'app-auth-login')

@section('content')

<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <div class="card app-auth-login-card">
            <div class="card-header">
                <h2 class="card-title">{{ __('Login') }}</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div class="form-group form-row">
                        <label for="email" class="col-sm-2 offset-sm-1 col-form-label">{{ __('Email address') }}</label>
                        <div class="col-sm-8">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-row">
                        <label for="password"  class="col-sm-2 offset-sm-1 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-8">
                            <input id="password" name="password" type="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-row">
                        <div class="col-sm-10 offset-sm-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-sm-8 offset-sm-3">
                            <input id="remember" name="remember" type="checkbox" class=""  {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-sm-8 offset-sm-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                            @endif
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
