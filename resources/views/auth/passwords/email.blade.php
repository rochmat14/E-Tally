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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="">
                            <h1 class="mb-2">Reset Password</h1>
                        </div>
                        <hr>

                        <div class="input-group mb-3">

                            <span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"/><circle cx="12" cy="8" opacity=".3" r="2"/><path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"/></svg></span>
                    

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email here !">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                        </div>
                        

                        <div class="row">
                            <div class="col-12">
                                
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                </button>

                                &nbsp; 
                                &nbsp; 
                                |
                                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'login' )) }}" class="btn btn-link box-shadow-0 px-0">Back Login ?</a>
                            </div>
                        </div>
                    
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
