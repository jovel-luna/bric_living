@extends('layouts.app', ['pageSlug' => 'login'])

@section('authorization')
<div class="container login-container">
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-4">
            <div class="site-logo">
                @if(!getSettings('portal-title'))
                    <img src="{{ url(getSettings('portal-logo')) }}" alt="Bric Living">
                @else
                    <img src="/img/system_logo_default.png" alt="Bric Living">
                @endif
            </div>
            <h3 class="text-center w-700 px-5">{{ getSettings('portal-title') }}</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="login" class="col-form-label">{{ __('Username/Email') }}</label>
                    <input id="login" type="text" class="form-control login-username{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required>
                    @if ($errors->has('username') || $errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="col-form-label">{{ __('Password') }}</label>

                    <div class="password-container">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <i id="togglePassword" class="far fa-eye"></i>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3" style="padding: 0px 5px;">
                    <div class="remember-container">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="forgot-container">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-login">
                    {{ __('Log In') }}
                </button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
        });
    </script>
@endpush
@endsection
