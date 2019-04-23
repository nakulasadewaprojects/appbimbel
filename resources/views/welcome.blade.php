<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>APP Bimbel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/lity/dist/lity.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/style/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/line-awesome/css/line-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/socicon/css/socicon.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">

	<script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/tether/dist/js/tether.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/lity/dist/lity.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<meta name="description" content="Metronic - #1 Selling Premium Bootstrap Admin Dashboard Theme of All Time. Build with Twitter Bootstrap 4, SASS, Angular 4. Trusted By Tens of Thousands Users." />
	<link rel="canonical" href="http://keenthemes.com/" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Premium Bootstrap Admin Themes" />
	<meta property="og:description" content="Metronic - #1 Selling Premium Bootstrap Admin Theme of All Time. Build with Twitter Bootstrap 4, SASS, Angular 4. Trusted By Tens of Thousands Users." />
	<meta property="og:url" content="http://keenthemes.com/" />
	<meta property="og:site_name" content="Keenthemes" />
	<meta property="article:publisher" content="https://www.facebook.com/keenthemes" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:description" content="Metronic - #1 Selling Premium Bootstrap Admin Theme of All Time. Build with Twitter Bootstrap 4, SASS, Angular 4, Material Design. Trusted By Tens of Thousands Users." />
	<meta name="twitter:title" content="Premium Bootstrap Admin Themes" />
	<meta name="twitter:domain" content="Keenthemes" />
	<link rel="shortcut icon" href="assets/demo/demo6/media/img/logo/favicon.ico" />


	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<!--
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
-->
</head>

<body>
	<div class="wrapper">
		<!-- wrapper -->
		<section class="section section--header">
			<!-- section -->
			<header>
				<!-- header -->
				<div class="content">
					<div class="header__handler">
						<div class="sidebar">
							<span class="hamburger">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="40px" height="40px">
									<g>
										<path d="m91.4,33.5h-53.8c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h53.9c2.3,0 4.1-1.8 4.1-4.1-0.1-2.3-1.9-4.1-4.2-4.1z" fill="#FFFFFF" />
										<path d="m91.4,87.4h-53.8c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h53.9c2.3,0 4.1-1.8 4.1-4.1-0.1-2.3-1.9-4.1-4.2-4.1z" fill="#FFFFFF" />
										<path d="m91.4,60.4h-53.8c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h53.9c2.3,0 4.1-1.8 4.1-4.1-0.1-2.3-1.9-4.1-4.2-4.1z" fill="#FFFFFF" />
									</g>
								</svg>
							</span>
						</div>
						<a href="index.html" class="metronic__logo">
							<img src="{{ asset('media/logo/metronic_whitelogo.png')}}" alt="Metronic">
						</a>
					</div>
					<div class="header__references">
						<!--
										<a href="http://keenthemes.com/forums/forum/support/metronic5/" class="header__references_support" target="_blank">
											Support
										</a>
										<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="header__references_purchase" target="_blank">
											Purchase
										</a>
-->

						<div class="top-right links">
							@if (Auth::guard('web')->check())
							<a href="{{ url('/dashboard') }}" class="intro__video">Dashboard</a>
							@elseif ( Auth::guard('siswa')->check())
							<a href="{{ url('/dashboardsiswa') }}" class="intro__video">Dashboard</a>
							@else
							<a href="{{ url('mentor/login') }}" class="intro__video">Mentor</a>
							<a href="{{ url('siswa/login') }}" class="intro__video">Siswa</a>
							@endif
						</div>

					</div>
				</div>
			</header>
			<!-- header END -->
			<div class="content">
				<!-- content -->
				<div class="intro">
					<!-- intro -->
					<img src="{{ asset('media/logo/logo_metronic_1.png') }}" alt="Metronic">
					<h2 class="intro__title">
						Aplikasi Bimbel Untuk Memudahkan Mentor Bertemu dengan Calon Siswa
					</h2>
					<br>
					<br>
					<br>
					
					<a href="home" class="intro__video" data-lity>
						<span>
							Watch Video
						</span>
						<i class="glyph-icon flaticon-visible"></i>
					</a>
				</div>
			</div>
		</section>
		<!-- <footer>
			<img src="{{ asset('media/logo/logo_keenthemes_2.png')}}" alt="">
			<form action="//keenthemes.us3.list-manage.com/subscribe/post?u=b10f23244c11e2946463ea844&amp;id=3aba0b6220" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<div class="subscribe">
					<input type="email" name="EMAIL" placeholder="Enter your email to subscribe newsletter">
					<button type="submit" name="subscribe">
						Submit
					</button>
				</div>
			</form>
			<div class="socials">
				<a href="http://twitter.com/keenthemes" target="_blank">
					<i class="socicon-twitter"></i>
				</a>
				<a href="http://facebook.com/keenthemes" target="_blank">
					<i class="socicon-facebook"></i>
				</a>
				<a href="https://dribbble.com/keenthemes" target="_blank">
					<i class="socicon-dribbble"></i>
				</a>
				<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">
					<i class="socicon-envato" alt=""></i>
				</a>
			</div>
		</footer> -->
	</div>
	<!-- wrapper END -->
	<div class="cover-layout"></div>
	<!-- <script>
		// Bind as an event handler
		$(document).ready(function() {
			$('.intro__video').on('click', '[data-lightbox]', lity);
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script> -->
</body>

</html>