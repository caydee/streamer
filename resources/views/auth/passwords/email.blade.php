@extends('auth.layout')

@section('content')



<div class="text-center mt-4">
    <h1 class="h2">{{ __('Reset password') }}</h1>
    <p class="lead">
        {{ __('Enter your email to reset your password.') }}
    </p>
</div>

<div class="card">
    <div class="card-body">
        <div class="m-sm-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">{{ __('Reset password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
