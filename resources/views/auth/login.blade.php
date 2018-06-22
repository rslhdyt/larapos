@extends('layouts.auth')

@section('main-content')
<div class="container">
    <h1 class="card-login mx-auto text-center mt-5 text-light">{{ config('app.name') }}</h1>

    <div class="card card-login mx-auto mt-3">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" type="password" placeholder="Password">
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
@endsection
