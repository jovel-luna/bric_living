@extends('layouts.app')

@section('authorization')
<div class="container login-container">
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-4">
            <div class="site-logo">
                <img src="{{ url('storage/image/logo.png') }}" alt="Bric Living">
            </div>
            <h3 class="text-center w-700">Reset Password</h3>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success btn-login">
                    {{ __('Send Password Reset Link') }}
                </button>
                <div class="mt-3 d-flex align-items-center justify-content-center">
                    <div class="new-user">
                        Go back to <a href="{{ route('login') }}"> {{ __('Login') }} </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
