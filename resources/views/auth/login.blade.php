@extends('layouts.app')

@section('content')



<div class="container mt-4 mb-4 border border-info rounded rounded-3 bdcontainer">
    <div class="row justify-content-center align-items-center p-3 loginrow">
        <div class="col-md-5">
           
            <img class="img rounded-3 loginimg" src="{{ asset('img_login/aCard6.jpg') }}" alt="" srcset="">
        </div>
        
        <div class="col-md-7">
            <div class="row justify-content-center align-items-center p-3">
                <div class="col-md-12 text-center mb-5">
                    <h1 class="fw-bold text-info">{{ __('Nyanko~') }}</h1>
                    <h2 class="mb-4 fw-bold text-info">{{ __('Login') }}</h2>
                </div>
                <div class="col-md-12 p-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
            
                            <div class="col-md-7">
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
            
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
            
                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Login~') }}
                                </button>
                                @if (Route::has('password.request'))
                                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Lupa password?') }}
                                    </a> --}}
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
