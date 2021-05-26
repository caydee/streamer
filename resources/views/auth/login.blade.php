@extends('auth.layout')

@section('content')
    <div class="text-center mt-4">
        <p class="lead">
            {{ __('Sign in to your account to continue') }}
        </p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <div class="text-center">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Andrew Jones" class="img-fluid rounded-circle" width="132" height="132" />
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror @error('username') is-invalid @enderror" type="text" name="login" placeholder="Enter your username or email " id="email" value="{{ old('login') }}" required autocomplete="login" autofocus />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label id="password">{{ __('Password') }}</label>
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </small>
                    </div>
                    <input type="hidden" name="redirect" value="{{ url('/cms') }}">
                    <div>
                        <div class="custom-control custom-checkbox align-items-center">
                            <input type="checkbox" class="custom-control-input" value="remember" name="remember"  {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label text-small">{{ __('Remember me next time') }}</label>
                        </div>
                    </div>
                    <div class="text-center mt-3">

                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Sign in') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection
