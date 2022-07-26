@extends('layouts.layout_login')
@php 

    $assets = asset('template_assets');

@endphp

@section('content')

<div class="w-80 page-content">
    <div class="page-single-content">
        <div class="card-body p-6">
            <div class="row">
                <div class="col-md-8 mx-auto d-block">
                    

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="">
                            <h1 class="mb-2">Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                        </div>
                        
                        <hr>
                        @if (session('status'))
                              <div class="alert alert-success">
                                  {{ session('status') }}
                              </div>
                        @endif
                        
                        <div class="input-group mb-3">

                            <span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"/><circle cx="12" cy="8" opacity=".3" r="2"/><path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"/></svg></span>

                            

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg></span>

                            
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="input-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ url('password/reset') }}" class="btn btn-link box-shadow-0 px-0">Lupa password ?</a>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block"> <i class="fe fe-arrow-right"></i> Login</button>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="font-weight-normal fs-16">Jika anda belum terdaftar sebagai members <a class="btn-link font-weight-normal" href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'registers' )) }}">Register Disini !</a></div>
                        </div>

                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
