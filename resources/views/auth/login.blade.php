@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="container-fluid" style="height: 100%; padding-bottom: 100px; padding-top: 100px;">
        <div class="row justify-content-center">
        <div class="col-md-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-5">
            <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <h1 class="mb-5 me-3">Sign in with</h1>
            </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input placeholder="Enter a valid email address"  type="email" id="form3Example3" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <label class="form-label" for="form3Example3">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input placeholder="Enter password" type="password" id="form3Example4" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <label class="form-label" for="form3Example4">Password</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>

                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Login') }}</button>
                </div>

            </form>
        </div>
        </div>
    </div>
    </section>

coba@gmail.com || 12345678
@endsection
