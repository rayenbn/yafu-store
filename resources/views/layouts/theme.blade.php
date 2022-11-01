<?php
	use App\Http\Controllers\Controller;
	$global_settings = Controller::global_settings();
?>

<!doctype html>
<html lang="en">
<head>
<title>{{ $global_settings->meta_title ?? "" }}</title>
	@include('layouts.analitycs')
	<!--meta info-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
	<meta name="author" content="digitafro.com">
	{!! SEOMeta::generate() !!}
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">
	<!-- Fonts -->
	<link rel="stylesheet" href="{{ asset('theme/assets/fonts/Lato/Lato.css') }}">

	<!-- Icons -->
	<link rel="stylesheet" href="{{ asset('theme/assets/fonts/flaticon/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/assets/fonts/webfont/css/materialdesignicons.min.css') }}">

	<!-- Libs -->
	<link rel="stylesheet" href="{{ asset('theme/assets/libs/bootstrap-4.3.1/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/assets/libs/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/assets/libs/slick/slick.css') }}">

	<!-- Theme -->
	<link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
	<meta name="theme-color" content="#ECECEC">
	<script src="{{ asset('theme/assets/libs/jquery-2.2.3.min.js')}}"></script>
	<script src="{{ asset('theme/assets/js/intlTelInput.js')}}"></script> 
	@stack('head.scripts')
    @stack('head.styles')
</head> 

<body class="home">
	<div id="app">
		<div class="head-line"></div>

		<!--Header-->	
		@include('partials.themeHeader')
		<!--End Header-->

		<div class="page-wrap @if (request()->routeIs('blogs')) archive blog @endif 
								@if (request()->routeIs('shop'))archive shop @endif
								@if (request()->routeIs('shop.detail')) single shop @endif
								@if (request()->routeIs('shoppingcart')) cart shop @endif ">
			@yield('content')
		</div>

		<!--Footer-->
		@include('partials.footer')
		<!--End Footer-->

	</div>

	<div class="full-search-wrap">
		<div class="full-search container">
			<div class="close-s float-right js-close-search flaticon-cancel-button fi-2x"></div>
			<form action="/" class=" search-full-form">
				<div class="position-relative">
					<i class="search-icon flaticon-magnifying-glass-browser fi-2x"></i>
					<input type="text" id="s-full" class="search-full-form__input" placeholder="Search">
					<input type="submit" class="d-none">
				</div>
				<p class="hint">Type in your search and press enter</p>
			</form>
		</div>
	</div>

	<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
	<div id="js-back-to-top" class="back-to-top"><i class="flaticon-up-arrow-sign"></i> Page top</div>
	
	<!-- Libs -->
	
	<script src="{{ asset('theme/assets/libs/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('theme/assets/libs/select2/js/select2.min.js')}}"></script>
	<script src="{{ asset('theme/assets/libs/slick/slick.min.js')}}"></script> 
	
	
	<!-- Theme -->
	<!-- <script src="{{ asset('theme/assets/js/custom.js')}}"></script> -->
	<script src="{{ mix('/js/app.js') }}"></script>

	@yield('scripts')
</body>
</html>