@extends('layouts.app')

@section('content')


<div class="container mt-4 mb-4 border border-info rounded rounded-3 bdcontainer">
    <div class="row justify-content-center align-items-center p-3 loginrow">
        <div class="col-md-5">
           
            <img class="img rounded-3 loginimg" src="{{ asset('img_login/aCard3.jpg') }}" alt="" srcset="">
        </div>
        
        <div class="col-md-7">
            <div class="row justify-content-center align-items-center p-3">
                <div class="col-md-12 text-center mb-5">
                    <h1 class="fw-bold text-info">{{ __('Nyanko~') }}</h1>
                    <h2 class="mb-4 fw-bold text-info">{{ __('Register') }}</h2>
                </div>
                <div class="col-md-12">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3 offset-md-4">
                            <div class="col-mb-7 form-check ">
                                <input type="checkbox" class="form-check-input" id="role" name='role_id' value="1" required>
                                <label class="form-check-label" for="role">Saya menerima semua <a href="#"> term and privacy policy</a></label>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Daftar~') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
