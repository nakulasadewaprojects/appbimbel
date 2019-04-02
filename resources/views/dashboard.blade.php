<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			AppBimbel
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<link href="{{ asset('css/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    	<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />

	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-light ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="dashboard" class="m-brand__logo-wrapper">
										<img alt="" src="assets/demo/default/media/img/logo/logo.png"/>
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
									Mentor Dashboard
								</h3>
							</div>			
				<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-light" id="m_quicksearch" data-search-type="default">
	<!--BEGIN: Search Results -->
									<div class="m-dropdown__wrapper">
										<div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
													<div class="m-dropdown__content m-list-search m-list-search--skin-light"></div>
												</div>
											</div>
										</div>
									</div>
									<!--BEGIN: END Results -->
								</div>
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
											<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
												<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-music-2"></i>
													</span>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
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
										<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic m--hide">
													<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
												<span class="m-nav__link-icon m-topbar__usericon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-user-ok"></i>
													</span>
												</span>
												<span class="m-topbar__username m--hide">
													Nick
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center">
														<div class="m-card-user m-card-user--skin-light">
															<div class="m-card-user__pic">
																<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	M Rijal Zulfi
																</span>
																<a href="https://www.gmail.com" class="m-card-user__email m--font-weight-300 m-link">
																	rijalzulfi.mrz@gmail.com
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
																	<a href="profile" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					 My Profile
																				</span>
																				<span class="m-nav__link-badge">
																					<span class="m-badge m-badge--success">
																						2
																					</span>
																				</span>
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-share"></i>
																		<span class="m-nav__link-text">
																			Activity
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-chat-1"></i>
																		<span class="m-nav__link-text">
																			Messages
																		</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-info"></i>
																		<span class="m-nav__link-text">
																			FAQ
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																		<span class="m-nav__link-text">
																			Support
																		</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																	<a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
																		Logout
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li id="m_quick_sidebar_toggle" class="m-nav__item">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon m-nav__link-icon-alt">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-grid-menu"></i>
													</span>
												</span>
											</a>
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
	<div 
		id="m_ver_menu" 
		class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " 
		data-menu-vertical="true"
		 data-menu-scrollable="true" data-menu-dropdown-timeout="500"  
		>
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-layers"></i>
									<span class="m-menu__link-text">
										Resources
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
											<a  href="#" class="m-menu__link ">
												<span class="m-menu__link-text">
													Resources
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Timesheet
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Payroll
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Contacts
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-suitcase"></i>
									<span class="m-menu__link-text">
										Finance
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-text">
													Finance
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-graphic-1"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Support
											</span>
											<span class="m-menu__link-badge">
												<span class="m-badge m-badge--danger">
													23
												</span>
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="#" class="m-menu__link ">
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Support
														</span>
														<span class="m-menu__link-badge">
															<span class="m-badge m-badge--danger">
																23
															</span>
														</span>
													</span>
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Reports
												</span>
											</a>
										</li>
										<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
											<a  href="#" class="m-menu__link m-menu__toggle">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Cases
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu">
												<span class="m-menu__arrow"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
														<a  href="inner.html" class="m-menu__link ">
															<i class="m-menu__link-icon flaticon-computer"></i>
															<span class="m-menu__link-title">
																<span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">
																		Pending
																	</span>
																	<span class="m-menu__link-badge">
																		<span class="m-badge m-badge--warning">
																			10
																		</span>
																	</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
														<a  href="inner.html" class="m-menu__link ">
															<i class="m-menu__link-icon flaticon-signs-2"></i>
															<span class="m-menu__link-title">
																<span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">
																		Urgent
																	</span>
																	<span class="m-menu__link-badge">
																		<span class="m-badge m-badge--danger">
																			6
																		</span>
																	</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
														<a  href="inner.html" class="m-menu__link ">
															<i class="m-menu__link-icon flaticon-clipboard"></i>
															<span class="m-menu__link-title">
																<span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">
																		Done
																	</span>
																	<span class="m-menu__link-badge">
																		<span class="m-badge m-badge--success">
																			2
																		</span>
																	</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
														<a  href="inner.html" class="m-menu__link ">
															<i class="m-menu__link-icon flaticon-multimedia-2"></i>
															<span class="m-menu__link-title">
																<span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">
																		Archive
																	</span>
																	<span class="m-menu__link-badge">
																		<span class="m-badge m-badge--info m-badge--wide">
																			245
																		</span>
																	</span>
																</span>
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Clients
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Audit
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-light"></i>
									<span class="m-menu__link-text">
										Administration
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-text">
													Administration
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-share"></i>
									<span class="m-menu__link-text">
										Management
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-text">
													Management
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__section">
								<h4 class="m-menu__section-text">
									Reports
								</h4>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-graphic"></i>
									<span class="m-menu__link-text">
										Accounting
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-text">
													Accounting
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-pie-chart"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Products
											</span>
											<span class="m-menu__link-badge">
												<span class="m-badge m-badge--accent m-badge--wide m-badge--rounded">
													new
												</span>
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Products
														</span>
														<span class="m-menu__link-badge">
															<span class="m-badge m-badge--accent m-badge--wide m-badge--rounded">
																new
															</span>
														</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-clipboard"></i>
									<span class="m-menu__link-text">
										Sales
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-text">
													Sales
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover" data-redirect="true">
								<a  href="inner.html" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-technology"></i>
									<span class="m-menu__link-text">
										IPO
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  data-redirect="true">
											<a  href="inner.html" class="m-menu__link ">
												<span class="m-menu__link-text">
													IPO
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-subheader-search">
						<h2 class="m-subheader-search__title">
							Mencari Jadwal Mengajar
							<!-- <span class="m-subheader-search__desc">
								Onling Bookings Management
							</span> -->
						</h2>
						<form class="m-form">
							<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
								<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="Cari">
								<span class="m-input-icon__icon m-input-icon__icon--right">
									<span>
										<i class="la la-puzzle-piece"></i>
									</span>
								</span>
							</div>
							<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-md m-input-icon--right">
								<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="From">
								<span class="m-input-icon__icon m-input-icon__icon--right">
									<span>
										<i class="la la-calendar-check-o"></i>
									</span>
								</span>
							</div>
							<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-md m-input-icon--right">
								<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="To">
								<span class="m-input-icon__icon m-input-icon__icon--right">
									<span>
										<i class="la la-calendar-check-o"></i>
									</span>
								</span>
							</div>
							<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
							<button type="button" class="btn m-btn--pill m-subheader-search__submit-btn">
								Cari
							</button>
							<!-- <a href="#" class="m-subheader-search__link m-link">
								Advance Search
							</a> -->
						</form>
					</div>
					<div class="m-content">
<!--Begin::Main Portlet-->
						<div class="row">
							<div class="col-xl-12">
								<div class="m-portlet m-portlet--mobile ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													SIswa yang Terdaftar
												</h3>
											</div>
										</div>										
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
														<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
															<i class="la la-ellipsis-h m--font-brand"></i>
														</a>
														<div class="m-dropdown__wrapper">
															<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
															<div class="m-dropdown__inner">
																<div class="m-dropdown__body">
																	<div class="m-dropdown__content">
																		<ul class="m-nav">
																			<li class="m-nav__section m-nav__section--first">
																				<span class="m-nav__section-text">
																					Quick Actions
																				</span>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-share"></i>
																					<span class="m-nav__link-text">
																						Create Post
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-chat-1"></i>
																					<span class="m-nav__link-text">
																						Send Messages
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-multimedia-2"></i>
																					<span class="m-nav__link-text">
																						Upload File
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__section">
																				<span class="m-nav__section-text">
																					Useful Links
																				</span>
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
																			<div class="m-widget3__info">
														<span class="m-widget3__username">
															Melania Trump
														</span>
														<br>
														<span class="m-widget3__time">
															2 day ago
														</span>
													</div>
																			<li class="m-nav__separator m-nav__separator--fit m--hide"></li>
																			<li class="m-nav__item m--hide">
																				<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																					Submit
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<!--begin: Datatable -->
										<div class="m_datatable" id="m_datatable_latest_orders">
											<div class="m-section__content">
												<table class="table table-striped m-table">
													<thead>
														<tr>
															<th>
																No.
															</th>
															<th>
																Nama Lengkap
															</th>
															<th>
																Alamat
															</th>
															<th>
																Mata Pelajaran
															</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th scope="row">
																1
															</th>
															<td>
																Ahmad Jhon
															</td>
															<td>
																Lumajang
															</td>
															<td>
																Matematika
															</td>
														</tr>
														<tr>
															<th scope="row">
																2
															</th>
															<td>
																Maharani 
															</td>
															<td>
																Malang
															</td>
															<td>
																Bahasa Inggris
															</td>
														</tr>
														<tr>
															<th scope="row">
																3
															</th>
															<td>
																Syailendra
															</td>
															<td>
																Lamongan
															</td>
															<td>
																Bahasa Indonesia
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										
										<!--end: Datatable -->
									</div>
								</div>
							</div>
						</div>
						<!--End::Main Portlet-->   
<!--Begin::Main Portlet-->
						<div class="row">
							<div class="col-xl-6">
								<!--begin:: Widgets/Tasks -->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Jadwal
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
														Today
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content1" role="tab">
														Week
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab3_content1" role="tab">
														Month
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget2_tab1_content">
												<div class="m-widget2">
													<div class="m-widget2__item m-widget2__item--primary">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																Membuat nasi goreng jawa sedap!
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	By Elmatul
																</a>
															</span>
														</div>
														<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget2__item m-widget2__item--warning">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																Prepare Docs For Metting On Monday
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	By Sean
																</a>
															</span>
														</div>
														<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget2__item m-widget2__item--brand">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																Make Widgets Great Again.Estudiat Communy Elit
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	By Aziko
																</a>
															</span>
														</div>
														<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget2__item m-widget2__item--success">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																Make Metronic Great Again.Lorem Ipsum
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	By James
																</a>
															</span>
														</div>
														<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget2__item m-widget2__item--danger">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																Completa Financial Report For Emirates Airlines
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	By Bob
																</a>
															</span>
														</div>
														<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget2__item m-widget2__item--info">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																Completa Financial Report For Emirates Airlines
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	By Sean
																</a>
															</span>
														</div>
														<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="m_widget2_tab2_content"></div>
											<div class="tab-pane" id="m_widget2_tab3_content"></div>
										</div>
									</div>
								</div>
								<!--end:: Widgets/Tasks -->
							</div>
							<div class="col-xl-6">
								<!--begin:: Widgets/Support Tickets -->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Support Tickets
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
													<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
														<i class="la la-ellipsis-h m--font-brand"></i>
													</a>
													<div class="m-dropdown__wrapper">
														<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
										<div class="m-widget3">
											<div class="m-widget3__item">
												<div class="m-widget3__header">
													<div class="m-widget3__user-img">
														<img class="m-widget3__img" src="assets/app/media/img/users/user1.jpg" alt="">
													</div>
													<div class="m-widget3__info">
														<span class="m-widget3__username">
															Melania Trump
														</span>
														<br>
														<span class="m-widget3__time">
															2 day ago
														</span>
													</div>
													<span class="m-widget3__status m--font-info">
														Pending
													</span>
												</div>
												<div class="m-widget3__body">
													<p class="m-widget3__text">
														Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
													</p>
												</div>
											</div>
											<div class="m-widget3__item">
												<div class="m-widget3__header">
													<div class="m-widget3__user-img">
														<img class="m-widget3__img" src="assets/app/media/img/users/user4.jpg" alt="">
													</div>
													<div class="m-widget3__info">
														<span class="m-widget3__username">
															Lebron King James
														</span>
														<br>
														<span class="m-widget3__time">
															1 day ago
														</span>
													</div>
													<span class="m-widget3__status m--font-brand">
														Open
													</span>
												</div>
												<div class="m-widget3__body">
													<p class="m-widget3__text">
														Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.Ut wisi enim ad minim veniam,quis nostrud exerci tation ullamcorper.
													</p>
												</div>
											</div>
											<div class="m-widget3__item">
												<div class="m-widget3__header">
													<div class="m-widget3__user-img">
														<img class="m-widget3__img" src="assets/app/media/img/users/user5.jpg" alt="">
													</div>
													<div class="m-widget3__info">
														<span class="m-widget3__username">
															Deb Gibson
														</span>
														<br>
														<span class="m-widget3__time">
															3 weeks ago
														</span>
													</div>
													<span class="m-widget3__status m--font-success">
														Closed
													</span>
												</div>
												<div class="m-widget3__body">
													<p class="m-widget3__text">
														Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--end:: Widgets/Support Tickets -->
							</div>
						</div>
						<!--End::Main Portlet-->
<!--Begin::Main Portlet-->
						<div class="row">
							<div class="col-xl-12">
								<!--begin::Portlet-->
								<div class="m-portlet" id="m_portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-map-location"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Calendar
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
														<span>
															<i class="la la-plus"></i>
															<span>
																Add Event
															</span>
														</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div id="m_calendar"></div>
									</div>
								</div>
								<!--end::Portlet-->
							</div>
						</div>
						<!--End::Main Portlet-->
<!--Begin::Main Portlet-->
						<div class="row">
							<div class="col-xl-12">
								<!--begin:: Widgets/Best Sellers-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Best Sellers
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget5_tab1_content" role="tab">
														Last Month
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content" role="tab">
														last Year
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab3_content" role="tab">
														All time
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<!--begin::Content-->
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
												<!--begin::m-widget5-->
												<div class="m-widget5">
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Great Logo Designn
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-label">
																	author:
																</span>
																<span class="m-widget5__info-author-name">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																19,200
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																1046
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Branding Mockup
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																24,583
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																3809
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Awesome Mobile App
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																10,054
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																1103
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
												</div>
												<!--end::m-widget5-->
											</div>
											<div class="tab-pane" id="m_widget5_tab2_content" aria-expanded="false">
												<!--begin::m-widget5-->
												<div class="m-widget5">
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Branding Mockup
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																24,583
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																3809
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Great Logo Designn
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																19,200
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																1046
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Awesome Mobile App
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																10,054
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																1103
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
												</div>
												<!--end::m-widget5-->
											</div>
											<div class="tab-pane" id="m_widget5_tab3_content" aria-expanded="false">
												<!--begin::m-widget5-->
												<div class="m-widget5">
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Branding Mockup
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																10.054
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																1103
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Great Logo Designn
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																24,583
															</span>
															<br>
															<span class="m-widget5__sales">
																sales
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																3809
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__pic">
															<img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt="">
														</div>
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																Awesome Mobile App
															</h4>
															<span class="m-widget5__desc">
																Make Metronic Great  Again.Lorem Ipsum Amet
															</span>
															<div class="m-widget5__info">
																<span class="m-widget5__author">
																	Author:
																</span>
																<span class="m-widget5__info-author m--font-info">
																	Fly themes
																</span>
																<span class="m-widget5__info-label">
																	Released:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	23.08.17
																</span>
															</div>
														</div>
														<div class="m-widget5__stats1">
															<span class="m-widget5__number">
																19,200
															</span>
															<br>
															<span class="m-widget5__sales">
																1046
															</span>
														</div>
														<div class="m-widget5__stats2">
															<span class="m-widget5__number">
																1046
															</span>
															<br>
															<span class="m-widget5__votes">
																votes
															</span>
														</div>
													</div>
												</div>
												<!--end::m-widget5-->
											</div>
										</div>
										<!--end::Content-->
									</div>
								</div>
								<!--end:: Widgets/Best Sellers-->
							</div>
						</div>
						<!--End::Main Portlet-->
						<div class="m-grid__item m-grid__item--fluid m-wrapper">
							<!-- BEGIN: Subheader -->
							<div class="m-subheader ">
								<div class="d-flex align-items-center">
									<div class="mr-auto">
										<h3 class="m-subheader__title m-subheader__title--separator">
											Dropzone
										</h3>
										<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
											<li class="m-nav__item m-nav__item--home">
												<a href="#" class="m-nav__link m-nav__link--icon">
													<i class="m-nav__link-icon la la-home"></i>
												</a>
											</li>
											<li class="m-nav__separator">
												-
											</li>
											<li class="m-nav__item">
												<a href="" class="m-nav__link">
													<span class="m-nav__link-text">
														Forms
													</span>
												</a>
											</li>
											<li class="m-nav__separator">
												-
											</li>
											<li class="m-nav__item">
												<a href="" class="m-nav__link">
													<span class="m-nav__link-text">
														Form Widgets
													</span>
												</a>
											</li>
											<li class="m-nav__separator">
												-
											</li>
											<li class="m-nav__item">
												<a href="" class="m-nav__link">
													<span class="m-nav__link-text">
														Dropzone
													</span>
												</a>
											</li>
										</ul>
									</div>
									<div>
										<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
											<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
												<i class="la la-plus m--hide"></i>
												<i class="la la-ellipsis-h"></i>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav">
																<li class="m-nav__section m-nav__section--first m--hide">
																	<span class="m-nav__section-text">
																		Quick Actions
																	</span>
																</li>
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
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																	<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																		Submit
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END: Subheader -->
							<div class="m-content">
								<!--begin::Portlet-->
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Dropzone File Upload Examples
												</h3>
											</div>
										</div>
									</div>
									<!--begin::Form-->
									<form class="m-form m-form--fit m-form--label-align-right">
										<div class="m-portlet__body">
											<div class="form-group m-form__group row">
												<label class="col-form-label col-lg-3 col-sm-12">
													Single File Upload
												</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="m-dropzone dropzone dz-clickable" action="inc/api/dropzone/upload.php" id="m-dropzone-one">
														<div class="m-dropzone__msg dz-message needsclick">
															<h3 class="m-dropzone__msg-title">
																Drop files here or click to upload.
															</h3>
															<span class="m-dropzone__msg-desc">
																This is just a demo dropzone. Selected files are
																<strong>
																	not
																</strong>
																actually uploaded.
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-form-label col-lg-3 col-sm-12">
													Multiple File Upload
												</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="inc/api/dropzone/upload.php" id="m-dropzone-two">
														<div class="m-dropzone__msg dz-message needsclick">
															<h3 class="m-dropzone__msg-title">
																Drop files here or click to upload.
															</h3>
															<span class="m-dropzone__msg-desc">
																Upload up to 10 files
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-form-label col-lg-3 col-sm-12">
													File Type Validation
												</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="m-dropzone dropzone m-dropzone--success dz-clickable" action="inc/api/dropzone/upload.php" id="m-dropzone-three">
														<div class="m-dropzone__msg dz-message needsclick">
															<h3 class="m-dropzone__msg-title">
																Drop files here or click to upload.
															</h3>
															<span class="m-dropzone__msg-desc">
																Only image, pdf and psd files are allowed for upload
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-9 ml-lg-auto">
														<button type="reset" class="btn btn-brand">
															Submit
														</button>
														<button type="reset" class="btn btn-secondary">
															Cancel
														</button>
													</div>
												</div>
											</div>
										</div>
									</form>
									<!--end::Form-->
								</div>
								<!--end::Portlet-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end:: Body -->
<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2019 &copy; Aplikasi Bimbel Online Kekinian 
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
											About
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#"  class="m-nav__link">
										<span class="m-nav__link-text">
											Privacy
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											T&C
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											Purchase
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
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
							Messages
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" 		data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">
							Settings
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">
							Logs
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active m-scrollable" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
						<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
							<div class="m-messenger__messages">
								<div class="m-messenger__message m-messenger__message--in">
									<div class="m-messenger__message-pic">
										<img src="assets/app/media/img//users/user3.jpg" alt=""/>
									</div>
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-username">
												Megan wrote
											</div>
											<div class="m-messenger__message-text">
												Hi Bob. What time will be the meeting ?
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--out">
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-text">
												Hi Megan. It's at 2.30PM
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--in">
									<div class="m-messenger__message-pic">
										<img src="assets/app/media/img//users/user3.jpg" alt=""/>
									</div>
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-username">
												Megan wrote
											</div>
											<div class="m-messenger__message-text">
												Will the development team be joining ?
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--out">
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-text">
												Yes sure. I invited them as well
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">
									2:30PM
								</div>
								<div class="m-messenger__message m-messenger__message--in">
									<div class="m-messenger__message-pic">
										<img src="assets/app/media/img//users/user3.jpg"  alt=""/>
									</div>
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-username">
												Megan wrote
											</div>
											<div class="m-messenger__message-text">
												Noted. For the Coca-Cola Mobile App project as well ?
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--out">
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-text">
												Yes, sure.
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--out">
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-text">
												Please also prepare the quotation for the Loop CRM project as well.
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">
									3:15PM
								</div>
								<div class="m-messenger__message m-messenger__message--in">
									<div class="m-messenger__message-no-pic m--bg-fill-danger">
										<span>
											M
										</span>
									</div>
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-username">
												Megan wrote
											</div>
											<div class="m-messenger__message-text">
												Noted. I will prepare it.
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--out">
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-text">
												Thanks Megan. I will see you later.
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__message m-messenger__message--in">
									<div class="m-messenger__message-pic">
										<img src="assets/app/media/img//users/user3.jpg"  alt=""/>
									</div>
									<div class="m-messenger__message-body">
										<div class="m-messenger__message-arrow"></div>
										<div class="m-messenger__message-content">
											<div class="m-messenger__message-username">
												Megan wrote
											</div>
											<div class="m-messenger__message-text">
												Sure. See you in the meeting soon.
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="m-messenger__seperator"></div>
							<div class="m-messenger__form">
								<div class="m-messenger__form-controls">
									<input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
								</div>
								<div class="m-messenger__form-tools">
									<a href="" class="m-messenger__form-attachment">
										<i class="la la-paperclip"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_settings" role="tabpanel">
						<div class="m-list-settings">
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">
									General Settings
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Email Notifications
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Site Tracking
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										SMS Alerts
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Backup Storage
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Audit Logs
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">
									System Settings
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										System Logs
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Error Reporting
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Applications Logs
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Backup Servers
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Audit Logs
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_logs" role="tabpanel">
						<div class="m-list-timeline">
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									System Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											12 new users registered
											<span class="m-badge m-badge--warning m-badge--wide">
												important
											</span>
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											System shutdown
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											New invoice received
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Database overloaded 89%
											<span class="m-badge m-badge--success m-badge--wide">
												resolved
											</span>
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											System error
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Production server down
											<span class="m-badge m-badge--danger m-badge--wide">
												pending
											</span>
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Production server up
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Applications Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											New order received
											<span class="m-badge m-badge--info m-badge--wide">
												urgent
											</span>
										</a>
										<span class="m-list-timeline__time">
											7 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											12 new users registered
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											System shutdown
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											New invoices received
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Database overloaded 89%
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											System error
											<span class="m-badge m-badge--info m-badge--wide">
												pending
											</span>
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Production server down
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Server Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Production server up
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											New order received
										</a>
										<span class="m-list-timeline__time">
											7 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											12 new users registered
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											System shutdown
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											New invoice received
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Database overloaded 89%
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											System error
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Production server down
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Production server up
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											New order received
										</a>
										<span class="m-list-timeline__time">
											1117 hrs
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end::Quick Sidebar -->		    
	    <!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		
		<script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/fullcalendar.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>

	</body>
</html>
