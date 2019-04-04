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
        <meta name="description" content="Metronic - #1 Selling Premium Bootstrap Admin Dashboard Theme of All Time. Build with Twitter Bootstrap 4, SASS, Angular 4. Trusted By Tens of Thousands Users."/>
		<link rel="canonical" href="http://keenthemes.com/"/>
		<meta property="og:locale" content="en_US"/>
		<meta property="og:type" content="website"/>
		<meta property="og:title" content="Premium Bootstrap Admin Themes"/>
		<meta property="og:description" content="Metronic - #1 Selling Premium Bootstrap Admin Theme of All Time. Build with Twitter Bootstrap 4, SASS, Angular 4. Trusted By Tens of Thousands Users."/>
		<meta property="og:url" content="http://keenthemes.com/"/>
		<meta property="og:site_name" content="Keenthemes"/>
		<meta property="article:publisher" content="https://www.facebook.com/keenthemes"/>
		<meta name="twitter:card" content="summary_large_image"/>
		<meta name="twitter:description" content="Metronic - #1 Selling Premium Bootstrap Admin Theme of All Time. Build with Twitter Bootstrap 4, SASS, Angular 4, Material Design. Trusted By Tens of Thousands Users."/>
		<meta name="twitter:title" content="Premium Bootstrap Admin Themes"/>
		<meta name="twitter:domain" content="Keenthemes"/>
		<link rel="shortcut icon" href="{{ asset('media/logo/favicon.ico') }}"/>

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
											<path d="m91.4,33.5h-53.8c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h53.9c2.3,0 4.1-1.8 4.1-4.1-0.1-2.3-1.9-4.1-4.2-4.1z" fill="#FFFFFF"/>
												<path d="m91.4,87.4h-53.8c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h53.9c2.3,0 4.1-1.8 4.1-4.1-0.1-2.3-1.9-4.1-4.2-4.1z" fill="#FFFFFF"/>
													<path d="m91.4,60.4h-53.8c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h53.9c2.3,0 4.1-1.8 4.1-4.1-0.1-2.3-1.9-4.1-4.2-4.1z" fill="#FFFFFF"/></g>
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
                        @if (Route::has('login'))
                            <div class="top-right links">
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}" class="header__references_purchase" target="_blank">Mentor</a>
                            <a href="{{ url('/register') }}" class="header__references_purchase" target="_blank">Siswa</a>
                        @endif
                            </div>
                        @endif
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
								The Ultimate Bootstrap Admin Theme Framework For Next Generation Applications
				            </h2>
								<a href="www.youtube.com/watch?v=VIbMn0QHBlw" class="intro__video" data-lity>
								<span>
								    Watch Video
								</span>
								<i class="glyph-icon flaticon-visible"></i>
								</a>
				    </div>
                </div>
            </section>
            <!-- section END -->
						<section class="section section--bg">
							<!-- section -->
							<div class="content">
								<blockquote class="blockquote">
									I run a team of 20 product managers, developers, QA and UX resources. Previously we designed everything ourselves.
				For our newest platform we tried out Metronic. I cannot overestimate the impact Metronic has had. It's accelerated
				development 3x and reduced QA issues by 50%. If you add up the reduced need for design time/resources, the increase
				in dev speed and the reduction in QA, it's probably saved us $100,000 on this project alone, and I plan to use
				it for all platforms moving forward.
									<br/>
									The flexibility of the design has also allowed us to put out a better looking & working platform and reduced my
				headaches by 90%. Thank you KeenThemes!
									<span class="blockquote__author">
										Jonathan Bartlett,
										<span>
											Metronic Customer
										</span>
									</span>
								</blockquote>
							</div>
						</section>
            <!-- section END -->
            <section class="section section--white">
							<!-- section -->
							<div class="content content--padding">
								<div class="advantages">
									<!-- advantages -->
									<div class="advantages__block">
										<i class="glyph-icon flaticon-open-box"></i>
										<div class="advantages__block__content">
											<h3>
												Powerful Framework
											</h3>
											<p>
												Everything within Metronic is customizable globally to provide limitless unique styled projects
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-web"></i>
										<div class="advantages__block__content">
											<h3>
												Multi Demo
											</h3>
											<p>
												Choose a perfect design for your next project among hundreds of demos
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-layers"></i>
										<div class="advantages__block__content">
											<h3>
												Limitless Components
											</h3>
											<p>
												A huge collection of components to power your application with the latest UI/UX trands
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-menu-button"></i>
										<div class="advantages__block__content">
											<h3>
												Angular4 Support
											</h3>
											<p>
												Enterprise ready Angular 4 integration with built-in authentication module and many more
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-car"></i>
										<div class="advantages__block__content">
											<h3>
												Bootstrap 4
											</h3>
											<p>
												Metronic deeply customizes Bootstrap with native look and feel
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-interface-6"></i>
										<div class="advantages__block__content">
											<h3>
												Exclusive Datatable Plugin
											</h3>
											<p>
												Our super sleek and intuitive Datatable comes packed with all advanced CRUD features
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-users"></i>
										<div class="advantages__block__content">
											<h3>
												50,000+ Strong
											</h3>
											<p>
												Metronic is the only theme trusted by over 50,000 developers world wide
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-alert-1"></i>
										<div class="advantages__block__content">
											<h3>
												Continuous Updates
											</h3>
											<p>
												Lifetime updates with new demos and features is guaranteed
											</p>
										</div>
									</div>
									<div class="advantages__block">
										<i class="glyph-icon flaticon-truck"></i>
										<div class="advantages__block__content">
											<h3>
												Quality Code
											</h3>
											<p>
												Metronic is writer with a code structure that all developers will be able to pick up easily and fall in love
											</p>
										</div>
									</div>
								</div>
								<!-- grid__advantages END -->
							</div>
						</section>
                        <!-- section END -->
						<section class="section section--bg">
							<!-- section -->
							<div class="content">
								<h2 class="title text-center">
									The Ultimate Bootstrap Admin Theme Trusted By Over 50,000 Developers World Wide
								</h2>
								<div class="text-center">
									<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="button">
										PURCHASE NOW
									</a>
								</div>
							</div>
						</section>
						<!-- section END -->
                        <footer>
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
						</footer>
        </div>
        <!-- wrapper END -->
					<div class="cover-layout"></div>
					<script>
						
  // Bind as an event handler
  $(document).ready(function() {
    $('.intro__video').on('click', '[data-lightbox]', lity);
    $('[data-toggle="tooltip"]').tooltip();
  });
					</script>
    </body>
</html>
                    
                    
                    
                    
                    

