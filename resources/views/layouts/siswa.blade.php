<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8" />
	<meta name="description" content="Latest updates and statistic charts">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<title>
		App Bimbel
	</title>

	<link href="http://localhost/appbimbel/public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors -->
	<link href="http://localhost/appbimbel/public/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="http://localhost/appbimbel/public/assets/demo/demo6/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Base Styles -->
	<link rel="shortcut icon" href="http://localhost/appbimbel/public/assets/demo/demo6/media/img/logo/favicon.ico" />
	<!-- zoom image css  -->
	<link rel="stylesheet" href="http://localhost/appbimbel/public/css/viewbox.css">
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<!-- BEGIN: Header -->
		<header class="m-grid__item    m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
			<div class="m-container m-container--fluid m-container--full-height">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<!-- BEGIN: Brand -->
					<div class="m-stack__item m-brand  m-brand--skin-light ">
						<div class="m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-stack__item--middle m-brand__logo">
								<a href="http://localhost/appbimbel/public/dashboardsiswa" class="m-brand__logo-wrapper">
									<img alt="" src="http://localhost/appbimbel/public/assets/demo/demo6/media/img/logo/logo.png" />
								</a>
							</div>
							<div class="m-stack__item m-stack__item--middle m-brand__tools">
								<!-- BEGIN: Responsive Aside Left Menu Toggler -->
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Responsive Header Menu Toggler -->
								<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Topbar Toggler -->
								<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a>
								<!-- BEGIN: Topbar Toggler -->
							</div>
						</div>
					</div>
					<!-- END: Brand -->
					<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
						<div class="m-header__title">
							<h3 class="m-header__title-text">
								Siswa Dashboard
							</h3>
						</div>
						<!-- BEGIN: Horizontal Menu -->
						<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
							<i class="la la-close"></i>
						</button>
						<!-- END: Horizontal Menu -->
						<!-- BEGIN: Topbar -->
						<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-light" id="m_quicksearch" data-search-type="default">
							</div>
							<div class="m-stack__item m-topbar__nav-wrapper">
								<ul class="m-topbar__nav m-nav m-nav--inline">
									<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-right 	m-dropdown--mobile-full-width" data-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
											<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
											<span class="m-nav__link-icon">
												<span class="m-nav__link-icon-wrapper">
													<i class="flaticon-music-2"></i>
												</span>
											</span>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center">
													<span class="m-dropdown__header-title">
														9 New
													</span>
													<span class="m-dropdown__header-subtitle">
														User Notifications
													</span>
												</div>
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
															<li class="nav-item m-tabs__item">
																<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
																	Alerts
																</a>
															</li>
															<li class="nav-item m-tabs__item">
																<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
																	Events
																</a>
															</li>
															<li class="nav-item m-tabs__item">
																<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">
																	Logs
																</a>
															</li>
														</ul>
														<div class="tab-content">
															<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
																<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
																	<div class="m-list-timeline m-list-timeline--skin-light">
																		<div class="m-list-timeline__items">
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
																				<span class="m-list-timeline__text">
																					12 new users registered
																				</span>
																				<span class="m-list-timeline__time">
																					Just now
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge"></span>
																				<span class="m-list-timeline__text">
																					System shutdown
																					<span class="m-badge m-badge--success m-badge--wide">
																						pending
																					</span>
																				</span>
																				<span class="m-list-timeline__time">
																					14 mins
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge"></span>
																				<span class="m-list-timeline__text">
																					New invoice received
																				</span>
																				<span class="m-list-timeline__time">
																					20 mins
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge"></span>
																				<span class="m-list-timeline__text">
																					DB overloaded 80%
																					<span class="m-badge m-badge--info m-badge--wide">
																						settled
																					</span>
																				</span>
																				<span class="m-list-timeline__time">
																					1 hr
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge"></span>
																				<span class="m-list-timeline__text">
																					System error -
																					<a href="#" class="m-link">
																						Check
																					</a>
																				</span>
																				<span class="m-list-timeline__time">
																					2 hrs
																				</span>
																			</div>
																			<div class="m-list-timeline__item m-list-timeline__item--read">
																				<span class="m-list-timeline__badge"></span>
																				<span href="" class="m-list-timeline__text">
																					New order received
																					<span class="m-badge m-badge--danger m-badge--wide">
																						urgent
																					</span>
																				</span>
																				<span class="m-list-timeline__time">
																					7 hrs
																				</span>
																			</div>
																			<div class="m-list-timeline__item m-list-timeline__item--read">
																				<span class="m-list-timeline__badge"></span>
																				<span class="m-list-timeline__text">
																					Production server down
																				</span>
																				<span class="m-list-timeline__time">
																					3 hrs
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge"></span>
																				<span class="m-list-timeline__text">
																					Production server up
																				</span>
																				<span class="m-list-timeline__time">
																					5 hrs
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
																<div class="m-scrollable" m-scrollabledata-scrollable="true" data-max-height="250" data-mobile-max-height="200">
																	<div class="m-list-timeline m-list-timeline--skin-light">
																		<div class="m-list-timeline__items">
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																				<a href="" class="m-list-timeline__text">
																					New order received
																				</a>
																				<span class="m-list-timeline__time">
																					Just now
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
																				<a href="" class="m-list-timeline__text">
																					New invoice received
																				</a>
																				<span class="m-list-timeline__time">
																					20 mins
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																				<a href="" class="m-list-timeline__text">
																					Production server up
																				</a>
																				<span class="m-list-timeline__time">
																					5 hrs
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																				<a href="" class="m-list-timeline__text">
																					New order received
																				</a>
																				<span class="m-list-timeline__time">
																					7 hrs
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																				<a href="" class="m-list-timeline__text">
																					System shutdown
																				</a>
																				<span class="m-list-timeline__time">
																					11 mins
																				</span>
																			</div>
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																				<a href="" class="m-list-timeline__text">
																					Production server down
																				</a>
																				<span class="m-list-timeline__time">
																					3 hrs
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
																<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
																	<div class="m-stack__item m-stack__item--center m-stack__item--middle">
																		<span class="">
																			All caught up!
																			<br>
																			No new logs.
																		</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>


										</div>

									</li>
									<li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle">
											<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
											<span class="m-nav__link-icon">
												<span class="m-nav__link-icon-wrapper">
													<i class="flaticon-share"></i>
												</span>
											</span>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center">
													<span class="m-dropdown__header-title">
														Quick Actions
													</span>
													<span class="m-dropdown__header-subtitle">
														Shortcuts
													</span>
												</div>
												<div class="m-dropdown__body m-dropdown__body--paddingless">
													<div class="m-dropdown__content">
														<div class="m-scrollable" data-scrollable="false" data-max-height="380" data-mobile-max-height="200">
															<div class="m-nav-grid m-nav-grid--skin-light">
																<div class="m-nav-grid__row">
																	<a href="#" class="m-nav-grid__item">
																		<i class="m-nav-grid__icon flaticon-file"></i>
																		<span class="m-nav-grid__text">
																			Generate Report
																		</span>
																	</a>
																	<a href="#" class="m-nav-grid__item">
																		<i class="m-nav-grid__icon flaticon-time"></i>
																		<span class="m-nav-grid__text">
																			Add New Event
																		</span>
																	</a>
																</div>
																<div class="m-nav-grid__row">
																	<a href="#" class="m-nav-grid__item">
																		<i class="m-nav-grid__icon flaticon-folder"></i>
																		<span class="m-nav-grid__text">
																			Create New Task
																		</span>
																	</a>
																	<a href="#" class="m-nav-grid__item">
																		<i class="m-nav-grid__icon flaticon-clipboard"></i>
																		<span class="m-nav-grid__text">
																			Completed Tasks
																		</span>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle">
											<span class="m-topbar__userpic m--hide">
												<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" />
											</span>
											<span class="m-nav__link-icon m-topbar__usericon">
												<span class="m-nav__link-icon-wrapper">
													<i class="flaticon-user-ok"></i>
												</span>
											</span>

										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center">
													<div class="m-card-user m-card-user--skin-light">
														<div class="m-card-user__pic">
															<img src="{{ url('/data_fileSiswa/'.$isCompleted->fotoProfile) }}" height="70px" width="100px" alt="" />
														</div>
														<div class="m-card-user__details">
															<span class="m-card-user__name m--font-weight-500">
																{{ Auth::user()->username }}
															</span>
															<a href="" class="m-card-user__email m--font-weight-300 m-link">
																{{ Auth::user()->email }}
															</a>
														</div>
													</div>
												</div>
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="m-nav m-nav--skin-light">
															<li class="m-nav__section m--hide">
																<span class="m-nav__section-text">
																	Section
																</span>
															</li>
															<li class="m-nav__item">
																<a href="http://localhost/appbimbel/public/myprofilesiswa" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-profile-1"></i>
																	<span class="m-nav__link-title">
																		<span class="m-nav__link-wrap">
																			<span class="m-nav__link-text">
																				My Profile
																			</span>
																		</span>
																	</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="header/profile.html" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-info"></i>
																	<span class="m-nav__link-text">
																		Setting
																	</span>
																</a>
															</li>
															<li class="m-nav__separator m-nav__separator--fit"></li>
															<li class="m-nav__item">
																<a href="{{ route('logoutsiswa') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
																	Logout
																</a>
																<form id="logout-form" action="{{ route('logoutsiswa') }}" method="POST" style="display: none;">
																	@csrf
																</form>
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
						<!-- END: Topbar -->
					</div>
				</div>
			</div>
		</header>
		<!-- END: Header -->
		<!-- begin::Body -->
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			<!-- BEGIN: Left Aside -->
			<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
				<i class="la la-close"></i>
			</button>
			<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
				<!-- BEGIN: Aside Menu -->
				<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" data-menu-scrollable="true" data-menu-dropdown-timeout="500">
					<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="#" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon flaticon-layers"></i>
								<span class="m-menu__link-text">
									Menu
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="dashboardsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Cari Mentor
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Lihat Jadwal Saya
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="multimediasiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Multimedia
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Tutorial
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Quiz
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Report
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Informasi Payment
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Setting Jadwal
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Approval
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" data-redirect="true">
										<a href="calendarsiswa" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Konten
											</span>
										</a>
									</li>
						</li>


					</ul>
				</div>
				</li>

				</ul>
			</div>
			<!-- END: Aside Menu -->
		</div>
		@yield('content')
		<footer class="m-grid__item		m-footer ">
			<div class="m-container m-container--fluid m-container--full-height m-page__container">
				<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
					<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
						<span class="m-footer__copyright">
							2019 &copy; AppBimbel Kekinian
							<a href="#" class="m-link">
								AppBimbel
							</a>
						</span>
					</div>
					<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
						<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
							<li class="m-nav__item">
								<a href="#" class="m-nav__link">
									<span class="m-nav__link-text">
										Tentang
									</span>
								</a>
							</li>
							<li class="m-nav__item">
								<a href="#" class="m-nav__link">
									<span class="m-nav__link-text">
										Kontak
									</span>
								</a>
							</li>

							<li class="m-nav__item m-nav__item">
								<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
									<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<!-- end::Footer -->
	</div>
	<!-- end:: Page -->
	<!-- begin::Quick Sidebar -->

	<!-- end::Quick Sidebar -->
	<!-- begin::Scroll Top -->
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
	<!-- end::Scroll Top -->
	<!-- end::Scroll Top -->
	<!-- begin::Quick Nav -->
	<ul class="m-nav-sticky" style="margin-top: 30px;">
		<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Pendiidikan Terakhir Mentor" data-placement="left">
			<a href="filter">
					<i class="la la-comments-o"></i>
				</a>
			</li>
			
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Lokasi Mentor" data-placement="left">
				<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">
					<i class="la la-cart-arrow-down"></i>
				</a>
			</li>
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Rating Mentor" data-placement="left">
				<a href="http://keenthemes.com/metronic/documentation.html" target="_blank">
					<i class="la la-code-fork"></i>
				</a>
			</li>
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Prodi Mentor" data-placement="left">
				<a href="http://keenthemes.com/forums/forum/support/metronic5/" target="_blank">
					<i class="la la-life-ring"></i>
				</a>
			</li>
		</ul>
		<!-- begin::Quick Nav -->

		<!-- zoom image -->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<!--begin::Base Scripts -->
		<script src="http://localhost/appbimbel/public/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="http://localhost/appbimbel/public/assets/demo/demo6/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
		<!--begin::Page Vendors -->
		<script src="http://localhost/appbimbel/public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->
		<!--begin::Page Snippets -->
		<script src="http://localhost/appbimbel/public/assets/app/js/dashboard.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
		<!-- zoom image -->
		<script src="http://localhost/appbimbel/public/js/jquery.viewbox.min.js"></script>
		<!-- <script>
			$(document).ready(function(){
				$('select[name="pendidikan"]').on('change',function(){
				var pendidikanId = $('select[name="pendidikan"]').val()
				$('select[name="provinsi"]').val()
				;
				console.log(pendidikanId);
				// if(pendidikanId){
				// 	$.ajax({
				// 		url: '/appbimbel/public/filter/get',
				// 		type: "GET",
				// 		dataType: "json",
				// 		beforeSend: function(){
				// 		$('#loader').css("visibility", "visible");							
				// 		},
				// 		success: function(data) {

				// 		}
				// 	})
				// }
			});
			});
			
		</script> -->
		
		<script>
		var pathname = window.location.pathname;
		if (pathname == '/appbimbel/public/dashboardsiswa') {
			$(document).ready(function() {

				$('select[name="provinsi"]').on('change', function() {
					var kabupatenId = $('select[name="provinsi"]').val();
					if (kabupatenId) {
						$.ajax({
							url: '/appbimbel/public/kabupaten/get/' + kabupatenId,
							type: "GET",
							dataType: "json",
							beforeSend: function() {
								$('#loader').css("visibility", "visible");
							},

							success: function(data) {

								$('select[name="kabupaten"]').empty();
								$('select[name="kecamatan"]').empty();
								$('select[name="kelurahan"]').empty();
								$('select[name="kabupaten"]').append('<option value="">' + 'Semua Kabupaten' + '</option>');
								$('select[name="kecamatan"]').append('<option value="">' + 'Semua Kecamatan' + '</option>');
								$('select[name="kelurahan"]').append('<option value="">' + 'Semua Kelurahan' + '</option>');

								$.each(data, function(key, value) {


									$('select[name="kabupaten"]').append('<option value="' + key + '">' + value + '</option>');

								});
							},
							complete: function() {
								$('#loader').css("visibility", "hidden");
							}
						});
					} else {
						$('select[name="kabupaten"]').empty();
						$('select[name="kecamatan"]').empty();
						$('select[name="kelurahan"]').empty();
						$('select[name="kabupaten"]').append('<option value="">' + 'Semua Kabupaten' + '</option>');
						$('select[name="kecamatan"]').append('<option value="">' + 'Semua Kecamatan' + '</option>');
						$('select[name="kelurahan"]').append('<option value="">' + 'Semua Kelurahan' + '</option>');
					}

				});
			});

			$(document).ready(function() {

				$('select[name="kabupaten"]').on('change', function() {
					var kecamatanId = $(this).val();
					if (kecamatanId) {
						$.ajax({
							url: '/appbimbel/public/kecamatan/get/' + kecamatanId,
							type: "GET",
							dataType: "json",
							beforeSend: function() {
								$('#loader').css("visibility", "visible");
							},

							success: function(data) {

								$('select[name="kecamatan"]').empty();
								$('select[name="kelurahan"]').empty();
								$('select[name="kecamatan"]').append('<option value="">' + 'Semua Kecamatan' + '</option>');
								$('select[name="kelurahan"]').append('<option value="">' + 'Semua Kelurahan' + '</option>');

								$.each(data, function(key, value) {

									$('select[name="kecamatan"]').append('<option value="' + key + '">' + value + '</option>');

								});
							},
							complete: function() {
								$('#loader').css("visibility", "hidden");
							}
						});
					} else {
						$('select[name="kecamatan"]').empty();
						$('select[name="kelurahan"]').empty();
						$('select[name="kecamatan"]').append('<option value="">' + 'Semua Kecamatan' + '</option>');
						$('select[name="kelurahan"]').append('<option value="">' + 'Semua Kelurahan' + '</option>');
					}

				});
			});

			$(document).ready(function() {

				$('select[name="kecamatan"]').on('change', function() {
					var kelurahanId = $(this).val();
					if (kelurahanId) {
						$.ajax({
							url: '/appbimbel/public/kelurahan/get/' + kelurahanId,
							type: "GET",
							dataType: "json",
							beforeSend: function() {
								$('#loader').css("visibility", "visible");
							},

							success: function(data) {

								$('select[name="kelurahan"]').empty();
								$('select[name="kelurahan"]').append('<option value="">' + 'Semua Kelurahan' + '</option>');

								$.each(data, function(key, value) {

									$('select[name="kelurahan"]').append('<option value="' + key + '">' + value + '</option>');

								});
							},
							complete: function() {
								$('#loader').css("visibility", "hidden");
							}
						});
					} else {
						$('select[name="kelurahan"]').empty();
						$('select[name="kelurahan"]').append('<option value="">' + 'Semua Kelurahan' + '</option>');
					}

				});
			});
		} else {

			$(document).ready(function() {

				$('select[name="provinsi"]').on('change', function() {
					var kabupatenId = $('select[name="provinsi"]').val();
					if (kabupatenId) {
						$.ajax({
							url: '/appbimbel/public/kabupaten/get/' + kabupatenId,
							type: "GET",
							dataType: "json",
							beforeSend: function() {
								$('#loader').css("visibility", "visible");
							},

							success: function(data) {

								$('select[name="kabupaten"]').empty();
								$('select[name="kecamatan"]').empty();
								$('select[name="kelurahan"]').empty();
								$('select[name="kabupaten"]').append('<option value="">' + 'Pilih Kabupaten' + '</option>');
								$('select[name="kecamatan"]').append('<option value="">' + 'Pilih Kecamatan' + '</option>');
								$('select[name="kelurahan"]').append('<option value="">' + 'Pilih Kelurahan' + '</option>');

								$.each(data, function(key, value) {


									$('select[name="kabupaten"]').append('<option value="' + key + '">' + value + '</option>');

								});
							},
							complete: function() {
								$('#loader').css("visibility", "hidden");
							}
						});
					} else {
						$('select[name="kabupaten"]').empty();
						$('select[name="kecamatan"]').empty();
						$('select[name="kelurahan"]').empty();
						$('select[name="kabupaten"]').append('<option value="">' + 'Pilih Kabupaten' + '</option>');
						$('select[name="kecamatan"]').append('<option value="">' + 'Pilih Kecamatan' + '</option>');
						$('select[name="kelurahan"]').append('<option value="">' + 'Pilih Kelurahan' + '</option>');
					}

				});
			});

			$(document).ready(function() {

				$('select[name="kabupaten"]').on('change', function() {
					var kecamatanId = $(this).val();
					if (kecamatanId) {
						$.ajax({
							url: '/appbimbel/public/kecamatan/get/' + kecamatanId,
							type: "GET",
							dataType: "json",
							beforeSend: function() {
								$('#loader').css("visibility", "visible");
							},

							success: function(data) {

								$('select[name="kecamatan"]').empty();
								$('select[name="kelurahan"]').empty();
								$('select[name="kecamatan"]').append('<option value="">' + 'Pilih Kecamatan' + '</option>');
								$('select[name="kelurahan"]').append('<option value="">' + 'Pilih Kelurahan' + '</option>');

								$.each(data, function(key, value) {

									$('select[name="kecamatan"]').append('<option value="' + key + '">' + value + '</option>');

								});
							},
							complete: function() {
								$('#loader').css("visibility", "hidden");
							}
						});
					} else {
						$('select[name="kecamatan"]').empty();
						$('select[name="kelurahan"]').empty();
						$('select[name="kecamatan"]').append('<option value="">' + 'Pilih Kecamatan' + '</option>');
						$('select[name="kelurahan"]').append('<option value="">' + 'Pilih Kelurahan' + '</option>');
					}

				});
			});

			$(document).ready(function() {

				$('select[name="kecamatan"]').on('change', function() {
					var kelurahanId = $(this).val();
					if (kelurahanId) {
						$.ajax({
							url: '/appbimbel/public/kelurahan/get/' + kelurahanId,
							type: "GET",
							dataType: "json",
							beforeSend: function() {
								$('#loader').css("visibility", "visible");
							},

							success: function(data) {

								$('select[name="kelurahan"]').empty();
								$('select[name="kelurahan"]').append('<option value="">' + 'Pilih Kelurahan' + '</option>');

								$.each(data, function(key, value) {

									$('select[name="kelurahan"]').append('<option value="' + key + '">' + value + '</option>');

								});
							},
							complete: function() {
								$('#loader').css("visibility", "hidden");
							}
						});
					} else {
						$('select[name="kelurahan"]').empty();
						$('select[name="kelurahan"]').append('<option value="">' + 'Pilih Kelurahan' + '</option>');
					}

				});
			});
		}
	</script>

	<script>
		if ({
				{
					session() - > has('message')
				}
			}) {
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-center",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};

			toastr.success("Profil Anda telah diperbarui", "Sukses");
		}
	</script>

	<script>
		if ({
				{
					Auth::user() - > gender
				}
			} == 1) {
			document.getElementById("male").checked = true;
		} else {
			document.getElementById("female").checked = true;
		}
	</script>
	<!-- zoom image -->
	<script>
		$('.thumbnail').viewbox({
			template: '<div class="viewbox-container"><div class="viewbox-body"><div class="viewbox-header"></div><div class="viewbox-content"></div><div class="viewbox-footer"></div></div></div>',
			// loading spinner
			loader: '<div class="loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>',
			setTitle: true,
			margin: 20,
			resizeDuration: 300,
			openDuration: 200,
			closeDuration: 200,
			closeButton: true,
			navButtons: false,
			closeOnSideClick: true,
			nextOnContentClick: true,
			useGestures: true
		});
	</script>

</body>

</html>