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
					<h1 class="mb-2">Register Members</h1>
					
					<hr>
					<form method="POST" action="{{ route('register_act') }}">
                        @csrf
                        
						<div class="input-group mb-4">
							<span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z M12,10c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2s-2-0.9-2-2 C10,10.9,10.9,10,12,10z M16,18H8v-0.57c0-0.81,0.48-1.53,1.22-1.85C10.07,15.21,11.01,15,12,15c0.99,0,1.93,0.21,2.78,0.58 C15.52,15.9,16,16.62,16,17.43V18z"/></svg></span>
							<input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ old('name') }}">
						</div>
						@error('name')
							<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
								<strong>{{ $message }}</strong>
							</div>
                        @enderror
						
							
						
						<div class="input-group mb-4">
							<span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg></span>
							<input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}">
						</div>
						@error('email')
						
							<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
								<strong>{{ $message }}</strong>
							</div>
						
                        @enderror
						<div class="input-group mb-4">
							<span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg></span>
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						@error('password')
							<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
								<strong>{{ $message }}</strong>
							</div>
                        @enderror
						<div class="input-group mb-4">
							<span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg></span>
							<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
						</div>
						@error('confirm_password')
							<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
								<strong>{{ $message }}</strong>
							</div>
                        @enderror
						
						<div class="form-group">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" required />
								<span class="custom-control-label">Agree the <a href="{{ url('term_and_condition') }}" class="btn-link" target="_blank">terms and policy</a></span>
							</label>
						</div>
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-lg btn-primary btn-block px-4"><i class="fe fe-arrow-right"></i> Registers a new members</button>
							</div>
						</div>
					</form>
						<div class="pt-4">
							<div class="font-weight-normal fs-16">You Already have an account <a class="btn-link font-weight-normal" href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'login' )) }}">Login Here</a></div>
						</div>
				</div>
            </div>
        </div>
    </div>
</div>


@endsection
