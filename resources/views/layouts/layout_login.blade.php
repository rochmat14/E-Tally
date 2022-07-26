<!DOCTYPE html>
@php 

	$assets = asset('template_assets');

@endphp

<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		

		<!-- Title -->
		<title>{{ AppName() }}</title>

		<!--Favicon -->
		<link rel="icon" href="{{ $assets }}/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ $assets }}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ $assets }}/css/style.css" rel="stylesheet" />

		<!-- Dark css -->
		<link href="{{ $assets }}/css/dark.css" rel="stylesheet" />

		<!-- Skins css -->
		<link href="{{ $assets }}/css/skins.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ $assets }}/css/animated.css" rel="stylesheet" />

		@if(AppThemeBoxes() == 'y')
		{{-- Bokex --}}
		<link href="{{ $assets }}/css/boxed.css" rel="stylesheet" />
		@endif
		
		<!---Icons css-->
		<link href="{{ $assets }}/plugins/web-fonts/icons.css" rel="stylesheet" />
		<link href="{{ $assets }}/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="{{ $assets }}/plugins/web-fonts/plugin.css" rel="stylesheet" />

	</head>

	<body class="{{ AppThemeDashboard() }} {{ AppThemeSidebar() }}">

		<div class="page page-style1 page-style2 ">
			<div class="d-md-flex">
				<div class="w-40 bg-style h-100vh page-style">
				    <div class="page-content">
				        <div class="page-single-content">
				            <div class="card-body text-white py-5 px-8 text-center">
				                <img src="{{ url('images/logo') }}/{{ AppLogo() }}" alt="img" class="w-100 mx-auto text-center">
				            </div>
				        </div>
				    </div>
				</div>
				@yield('content')

				
			</div>
		</div>

		<!-- Jquery js-->
		<script src="{{ $assets }}/js/vendors/jquery-3.5.1.min.js"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ $assets }}/plugins/bootstrap/popper.min.js"></script>
		<script src="{{ $assets }}/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="{{ $assets }}/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!-- Circle-progress js-->
		<script src="{{ $assets }}/js/vendors/circle-progress.min.js"></script>

		<!-- Jquery-rating js-->
		<script src="{{ $assets }}/plugins/rating/jquery.rating-stars.js"></script>

	</body>
</html>
