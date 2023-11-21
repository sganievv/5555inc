@extends('layouts.app')

@section('full-content')
    <div class="container">
        <div class="row jumbotron justify-content-center">
            <div class="col-md-4 col-md-offset-4">
                <h3 class="text-center">{{ __('nav.auth') }} </h3>

                <form method="POST" action="{{ route('auth.login') }}" style="margin-top: 50px">
                    @csrf

                    <div class="mb-3">
                        <label for="login" class="col-form-label text-md-end">{{ __('attributes.login') }}</label>
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-form-label text-md-end">{{ __('attributes.password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mt-5 text">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('nav.sign-in') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
