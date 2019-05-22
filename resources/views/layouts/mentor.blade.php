<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
	<meta charset="utf-8" />
	<title>
		App Bimbel
	</title>

	<!-- zoom image -->

	<!-- <script type="text/javascript" src="{{ asset('http://localhost/appbimbel/public/js/jquery.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('http://localhost/appbimbel/public/js/jquery.imgzoom.pack.js') }}"></script> -->



	<meta name="description" content="User profile view and edit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
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
	<link href="http://localhost/appbimbel/public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="http://localhost/appbimbel/public/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="http://localhost/appbimbel/public/assets/demo/demo6/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="http://localhost/appbimbel/public/assets/demo/demo6/media/img/logo/favicon.ico" />
	<link rel="stylesheet" href="http://localhost/appbimbel/public/css/viewbox.css">
	<link href="http://localhost/appbimbel/public/css/jquery.touchPDF.css" rel="stylesheet">

</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<header class="m-grid__item    m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
			<div class="m-container m-container--fluid m-container--full-height">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<div class="m-stack__item m-brand  m-brand--skin-light ">
						<div class="m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-stack__item--middle m-brand__logo">
								<a href="dashboard" class="m-brand__logo-wrapper">
									<img alt="" src="http://localhost/appbimbel/public/assets/demo/demo6/media/img/logo/logo.png" />
								</a>
								<h3 class="m-header__title">
									Apps
								</h3>
							</div>
							<div class="m-stack__item m-stack__item--middle m-brand__tools">
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
						<div class="m-header__title">
							<h3 class="m-header__title-text">
								App Bimbel (Mentor)
							</h3>
						</div>
						<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
							<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
								<li class="m-menu__item  m-menu__item--active m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
									<div class="m-menu__link m-menu__toggle">
										<span class="m-menu__item-here"></span>
										<span class="m-menu__link-text">
											Dashboard
										</span>
									</div>
								</li>
								<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
									<div class="m-menu__link m-menu__toggle">
										<span class="m-menu__item-here"></span>
										<i class="m-menu__link-icon flaticon-more-v3"></i>
										<span class="m-menu__link-text"></span>
									</div>
								</li>
							</ul>
						</div>
						<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-topbar__nav-wrapper">
								<ul class="m-topbar__nav m-nav m-nav--inline">
									<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-right 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
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
									<!-- <li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
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
									</li> -->
									<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle">
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
															<a href="{{ url('/data_file/'.$isCompleted->foto) }}"> <img src="{{ url('/data_file2/'.$isCompleted->foto) }}" class="thumbnail" alt="" />
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
																<a href="myProfile" class="m-nav__link">
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
																<a href="{{ route('logout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" onclick="event.preventDefault();
                                                     				document.getElementById('logout-form').submit();">
																	Logout
																</a>
																<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
					</div>
				</div>
			</div>
		</header>
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
				<i class="la la-close"></i>
			</button>
			<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
				<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" data-menu-scrollable="true" data-menu-dropdown-timeout="500">
					<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="http://localhost/appbimbel/public/dashboard" class="m-menu__link">
								<i class="m-menu__link-icon fa fa-home"></i>
							</a>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
								<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Home
											</span>
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="http://localhost/appbimbel/public/jadwal" class="m-menu__link">
								<i class="m-menu__link-icon flaticon-clipboard"></i>		
							</a>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">						
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Jadwal
											</span>
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="http://localhost/appbimbel/public/approvalmentor" class="m-menu__link">
								<i class="m-menu__link-icon flaticon-interface"></i>		
							</a>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">						
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Pengajuan
											</span>
										</div>
									</li>
								</ul>
							</div>
						</li>
						
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<div class="m-menu__link">
								<i class="m-menu__link-icon flaticon-interface-5"></i>
							</div>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Paket Bimbel
											</span>
										</div>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/paketbimbel" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Input Paket
											</span>
										</a>
									</li><li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/datapaket" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Data Paket
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<div class="m-menu__link">
								<i class="m-menu__link-icon flaticon-analytics"></i>
							</div>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Report
											</span>
										</div>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/report" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Input Laporan
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/datareport" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Table Report
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/exportexcel" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Export Excel
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<div  class="m-menu__link">
								<i class="m-menu__link-icon flaticon-list-1"></i>		
							</div>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">						
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Tutorial
											</span>
										</div>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/tutorial" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Upload
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/datatutorial" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Data Tutorial
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<div class="m-menu__link">
								<i class="m-menu__link-icon flaticon-multimedia-2"></i>		
							</div>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">						
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Multimedia
											</span>
										</div>
									</li>
									<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/multimedia" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Upload Multimedia
											</span>
										</a>
									</li><li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
										<a  href="http://localhost/appbimbel/public/multimedia" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Data Multimedia
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="http://localhost/appbimbel/public/payment" class="m-menu__link">
								<i class="m-menu__link-icon flaticon-coins"></i>
							</a>
							<div class="m-menu__submenu">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
										<div class="m-menu__link ">
											<span class="m-menu__link-text">
												Informasi Payment
											</span>
										</div>
									</li>
								</ul>
							</div>
						</li>											
					</ul>
				</div>
			</div>

			@yield('content')
			
		</div>
	</div>
	
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

	</div>
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://localhost/appbimbel/public/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/assets/demo/demo6/base/scripts.bundle.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/assets/app/js/dashboard.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/js/jquery.viewbox.min.js"></script>
	<script src="http://localhost/appbimbel/public/js/pdf.compatibility.js"></script>
	<script src="http://localhost/appbimbel/public/js/pdf.js"></script>
	<script src="http://localhost/appbimbel/public/js/jquery.touchSwipe.min.js"></script>
	<script src="http://localhost/appbimbel/public/js/jquery.touchPDF.js"></script>
	<script src="http://localhost/appbimbel/public/js/jquery.panzoom.js"></script>
	<script src="http://localhost/appbimbel/public/js/jquery.mousewheel.js"></script>
	<script src="http://localhost/appbimbel/public/js/bootstrap-select.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/js/select2.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/js/data-local.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/js/bootstrap-select.js" type="text/javascript"></script>
	<script src="http://localhost/appbimbel/public/js/bootstrap-timepicker.js" type="text/javascript"></script>
	
	<script>
		if ({{DB::table('tbdetailmentor')->where('idmentor', Auth::user()->idmentor)->value('statusPendidikan')}} == 1) {
			document.getElementById("selesai").checked = true;
		} else {
			document.getElementById("masihpendidikan").checked = true;
		}

		$(function() {
			$("button").on("click", function(event) {
				e.preventDefault();
				$(".hidden-control").attr("type", "text");
				$("form").submit();
			});

		});
	</script>

	<script>
		if ({{session()->has('message')}}) {
			console.log("jalan");
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

	<script type="text/javascript">
		$(function() {
			$("#myPDF").pdf(
				source: "demo.pdf",
				// MORE SETTINGS HERE
			});
		});
	</script>
	<script>
		// Path of PDF file to display
		source: null,
			// Title of the PDF to be displayed in the toolbar
			title: "TouchPDF",
			// Array of tabs to display on the side.
			tabs: [],
			// Default background color for all tabs.
			// Available colors are "green", "yellow", "orange", "brown",
			// "blue", "white", "black" and you can define your own colors with CSS.
			tabsColor: "beige",
			// Disable zooming of PDF document.
			disable < a href = "https://www.jqueryscript.net/zoom/" > Zoom < /a>: false,
		// Disable swipe to next/prev page of PDF document.
		disableSwipe: false,
			// Disable all internal and external links on PDF document
			disableLinks: false,
			// Disable the arrow keys for next/previous page and +/- for zooming
			disableKeys: false,
			// Force resize of PDF viewer on window resize
			redrawOnWindowResize: true,
			// Show a toolbar on top of the document with title,
			// page number and buttons for next/prev pages and zooming
			showToolbar: true,
			// A handler triggered when PDF document is loaded
			loaded: null,
			// A handler triggered each time a new page is displayed
			changed: null,
			// Text or HTML displayed on white page shown before document is loaded
			loadingHeight: 841,
			// Height in px of white page shown before document is loaded
			loadingWidth: 595,
			// Width in px of white page shown before document is loaded
			loadingHTML: "Loading PDF"
	</script>



	<!--end::Base Scripts -->
</body>
<!-- end::Body -->

</html>