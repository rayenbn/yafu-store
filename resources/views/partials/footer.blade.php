<?php

use App\Http\Controllers\Controller;

$footer = Controller::footer();
$global_settings =Controller::global_settings();
// $categories =Controller::footer_categories();
?>
<!--Footer-->
<footer class="page-footer">
	<div class="container">
		<div class="foot-info row">
			<div class="col-md-8">
				<div class="d-lg-flex align-items-end text-center text-md-left">
					<a href="/" class="logo-footer">
						<img src="/storage/logo/{{ $global_settings->footer_logo ?? ''}}" alt="">
					</a>
					<div class="ml-lg-4 page-footer__text">Wholesale pet toys supplier for e-commerce and Fba businesses</div>
				</div>
			</div>

			<div class="social col-md-4">
				<span>Follow us:</span>
				<ul class="social-links ml-md-3">
					@if (isset($footer->youtube))
					<li><a href="{{ $footer->youtube }}" target="_blank"><i class="mdi mdi-youtube"></i></a></li>
					@endif
					@if (isset($footer->fb))
					<li><a href="{{ $footer->fb }}" target="_blank"><i class="mdi mdi-facebook"></i></a></li>
					@endif
					@if (isset($footer->ig))
					<li><a href="{{ $footer->ig }}" target="_blank"><i class="mdi mdi-instagram"></i></a></li>
					@endif
					@if (isset($footer->twitter))
					<li><a href="{{ $footer->twitter }}" target="_blank"><i class="mdi mdi-twitter"></i></a></li>
					@endif
				</ul>
			</div>
		</div>

		<nav class="footer-navigation">
			<ul class="nav justify-content-center">
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/') }}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('aboutus') }}">Our Story</a>
				</li>
			
				 <li class="nav-item">
					<a class="nav-link" href="{{ route('shop') }}">Our products</a>
				</li>
			
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/') }}#samples">Samples</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('blogs') }}">Blog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('contactus') }}">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('cats-landingpage') }}">Cat toys manufacturer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('dogs-landingpage') }}">Dogs toys manufacturer</a>
				</li>
			</ul>
		</nav>

		<div class="footer-bottom">
			<div class="copyright">Copyright &copy; 2022<a href="https://afrolinegroup.com/"> AF Group </a>. All Rights Reserved.</div>
			<ul class="footer-bottom__menu">
				<li><a href="/privacy-policy">Privacy Policy</a></li>
				<li><a href="/terms-and-condition">Terms of use</a></li>
				<li><a href="/sitemap.xml">Sitemap</a></li>
			</ul>
		</div>
	</div>
</footer>
<!--End Footer-->