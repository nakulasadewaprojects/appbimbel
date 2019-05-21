@extends('layouts.mentor')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	@if (DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('statKomplit')!==7)
	<div class="m-alert m-alert--icon alert alert-warning" role="alert">
		<div class="m-alert__icon">
			<i class="la la-warning"></i>
		</div>
		<div class="m-alert__text">
			<strong>
				Luar biasa!
			</strong>
			Silakan lengkapi profil Anda agar dapat menerima siswa.
		</div>
		<div class="m-alert__actions" style="width: 160px;">
			<a class="btn btn-info btn-sm m-btn m-btn--pill m-btn--wide" href="http://localhost/appbimbel/public/profile">Lengkapi Sekarang</a>
		</div>
	</div>
	@endif
	@if (DB::table('siswabimbel')->where('NoIDTutor', Auth::user()->NoIDMentor)->value('statusBimbel')==1)
	<div class="m-alert m-alert--icon alert alert-info" role="alert">
		<div class="m-alert__icon">
			<i class="la la-info"></i>
		</div>
		<div class="m-alert__text">
			<strong>
				INFO!
			</strong>
			Ada siswa yang mengajukan bimbel, Silakan cek di menu approval
		</div>
		<div class="m-alert__actions" style="width: 160px;">
			<a class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide" href="http://localhost/appbimbel/public/approvalmentor">Lengkapi Sekarang</a>
		</div>
	</div>
	@endif

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/siswa.jpg" alt="First slide">
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/siswa.jpg" alt="Second slide">
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/siswa.jpg" alt="Third slide">
		  </div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="m-content">
		<!--Begin::Main Portlet-->
		<div class="m-portlet">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-xl-4">
						<!--begin:: Widgets/Stats2-1 -->
						<div class="m-widget1">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Member Profit
										</h3>
										<span class="m-widget1__desc">
											Awerage Weekly Profit
										</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-brand">
											+$17,800
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Orders
										</h3>
										<span class="m-widget1__desc">
											Weekly Customer Orders
										</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-danger">
											+1,800
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Issue Reports
										</h3>
										<span class="m-widget1__desc">
											System bugs and issues
										</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-success">
											-27,49%
										</span>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Stats2-1 -->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Daily Sales-->
						<div class="m-widget14">
							<div class="m-widget14__header m--margin-bottom-30">
								<h3 class="m-widget14__title">
									Daily Sales
								</h3>
								<span class="m-widget14__desc">
									Check out each collumn for more details
								</span>
							</div>
							<div class="m-widget14__chart" style="height:120px;">
								<canvas  id="m_chart_daily_sales"></canvas>
							</div>
						</div>
						<!--end:: Widgets/Daily Sales-->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Profit Share-->
						<div class="m-widget14">
							<div class="m-widget14__header">
								<h3 class="m-widget14__title">
									Profit Share
								</h3>
								<span class="m-widget14__desc">
									Profit Share between customers
								</span>
							</div>
							<div class="row  align-items-center">
								<div class="col">
									<div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
										<div class="m-widget14__stat">
											45
										</div>
									</div>
								</div>
								<div class="col">
									<div class="m-widget14__legends">
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-accent"></span>
											<span class="m-widget14__legend-text">
												37% Sport Tickets
											</span>
										</div>
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-warning"></span>
											<span class="m-widget14__legend-text">
												47% Business Events
											</span>
										</div>
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-brand"></span>
											<span class="m-widget14__legend-text">
												19% Others
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Profit Share-->
					</div>
				</div>
			</div>
		</div>
		<!--End::Main Portlet-->
		
		<!--Begin::Main Portlet-->
		<div class="row">
			<div class="col-xl-12">
				<!--begin:: Widgets/Top Products-->
				<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Trends
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
										All
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Activity
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-chat-1"></i>
																<span class="m-nav__link-text">
																	Messages
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-info"></i>
																<span class="m-nav__link-text">
																	FAQ
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																<span class="m-nav__link-text">
																	Support
																</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">
						<!--begin::Widget5-->
						<div class="m-widget4">
							<div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20" style="height:260px;">
								<canvas id="m_chart_trends_stats"></canvas>
							</div>
							<div class="m-widget4__item">
								<div class="m-widget4__img m-widget4__img--logo">
									<img src="assets/app/media/img/client-logos/logo3.png" alt="">
								</div>
								<div class="m-widget4__info">
									<span class="m-widget4__title">
										Phyton
									</span>
									<br>
									<span class="m-widget4__sub">
										A Programming Language
									</span>
								</div>
								<span class="m-widget4__ext">
									<span class="m-widget4__number m--font-danger">
										+$17
									</span>
								</span>
							</div>
							<div class="m-widget4__item">
								<div class="m-widget4__img m-widget4__img--logo">
									<img src="assets/app/media/img/client-logos/logo1.png" alt="">
								</div>
								<div class="m-widget4__info">
									<span class="m-widget4__title">
										FlyThemes
									</span>
									<br>
									<span class="m-widget4__sub">
										A Let's Fly Fast Again Language
									</span>
								</div>
								<span class="m-widget4__ext">
									<span class="m-widget4__number m--font-danger">
										+$300
									</span>
								</span>
							</div>
							<div class="m-widget4__item">
								<div class="m-widget4__img m-widget4__img--logo">
									<img src="assets/app/media/img/client-logos/logo2.png" alt="">
								</div>
								<div class="m-widget4__info">
									<span class="m-widget4__title">
										AirApp
									</span>
									<br>
									<span class="m-widget4__sub">
										Awesome App For Project Management
									</span>
								</div>
								<span class="m-widget4__ext">
									<span class="m-widget4__number m--font-danger">
										+$6700
									</span>
								</span>
							</div>
						</div>
						<!--end::Widget 5-->
					</div>
				</div>
				<!--end:: Widgets/Top Products-->
			</div>
		</div>
		<!--End::Main Portlet-->
	</div>
</div>
</div>
@endsection