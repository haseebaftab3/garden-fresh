@extends('layout.master')
@section('title', 'Login | Pets Medic')
@section('content')
    <section class="contact__area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-7">
                    <div class="contact__form-wrap">
                        <form method="POST" action="{{ route('login') }}" id="login-form" class="contact__form">
                            @csrf
                            <h2 class="title">Login</h2>
                            <span>Please enter your credentials to login.</span>

                            <!-- Email Address -->
                            <div class="form-grp mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required autofocus
                                    autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-grp mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                    type="password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="row justify-content-around">
                                <div class="col-6">
                                    <div class="form-check mb-3">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Log in') }}
                                </button>
                            </div>

                            <hr>

                            <div class="text-center mt-4">
                                <a href="{{ route('register') }}">
                                    Create a new account
                                </a>
                            </div>
                        </form>
                        <p class="ajax-response mb-0"></p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
