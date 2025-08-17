@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="row no-gutters h-100">
        <!-- Left Column: Logo -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #ececec; height: 100vh;">
            <img src="{{ asset('ex2.png') }}" alt="Logo" class="img-fluid" style="height: auto;">
        </div>

        <!-- Right Column: Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #2D0A32; height: 100vh; padding: 2rem;">
            <div class="card-body w-100" style="color: white; max-width: 500px; margin: auto;">
                <div class="text-center mb-4">
                    <img src="{{ asset('ban.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px; height: auto;">
                    <h4>Login Account</h4>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @if (session()->has('message'))
                        <div class="alert alert-warning text-center">{!! session('message') !!}</div>
                    @endif
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn" style="background-color: white; color: #2D0A32;">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem; /* Less padding on mobile */
        }
        .row {
            flex-direction: column; /* Stack items vertically */
        }
        .col-md-4, .col-md-8 {
            max-width: 100%; /* Full width on smaller screens */
        }
    }
</style>
@endsection
