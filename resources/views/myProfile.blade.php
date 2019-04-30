@extends('layouts.mentor') 
@section('content')
			
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<!-- BEGIN: Subheader -->
				@if (DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('statKomplit')!==6)
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
								<a class="btn btn-info btn-sm m-btn m-btn--pill m-btn--wide" href="profile">Lengkapi Sekarang</a>
							</div>
						</div>
						@endif
				<div class="m-subheader ">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="m-subheader__title ">
								Lihat Profil Saya
							</h3>
						</div>
						{{-- <div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
							</div> --}}
					</div>
				</div>
				<!-- END: Subheader -->
				<div class="m-content">
					<div class="row">
						<div class="col-xl-3 col-lg-4">
							<div class="m-portlet m-portlet--full-height  ">
								<div class="m-portlet__body">
									<div class="m-card-profile">
										<div class="m-card-profile__title m--hide">
											Your Profile
										</div>
										<div class="m-card-profile__pic">
											<div class="m-card-profile__pic-wrapper">
											<a href="{{ url('/data_file/'.$isCompleted->foto) }}" class="thumbnail"><img src="{{ url('/data_file2/'.$isCompleted->foto) }}" alt="" />
											</div>
										</div>
										<div class="m-card-profile__details">
											<span class="m-card-profile__name">
												{{ Auth::user()->username }}
											</span>
											<a href="" class="m-card-profile__email m-link">
												{{ Auth::user()->email }}
											</a>
										</div>
									</div>
									<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
										<li class="m-nav__separator m-nav__separator--fit"></li>
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
															Lihat Profil Saya
														</span>
														{{-- <span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span> --}}
													</span>
												</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="profile" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-edit"></i>
												<span class="m-nav__link-title">
													<span class="m-nav__link-wrap">
														<span class="m-nav__link-text">
															Edit Profil Saya
														</span>
														{{-- <span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span> --}}
													</span>
												</span>
											</a>
										</li>
										{{-- <li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-share"></i>
													<span class="m-nav__link-text">
														Activity
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-chat-1"></i>
													<span class="m-nav__link-text">
														Messages
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-graphic-2"></i>
													<span class="m-nav__link-text">
														Sales
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-time-3"></i>
													<span class="m-nav__link-text">
														Events
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
													<span class="m-nav__link-text">
														Support
													</span>
												</a>
											</li> --}}
									</ul>
									<div class="m-portlet__body-separator"></div>
									{{-- <div class="m-widget1 m-widget1--paddingless">
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
										</div> --}}
								</div>
							</div>
						</div>
						<div class="col-xl-9 col-lg-8">
							<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
								{{-- <div class="m-portlet__head">
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
														<i class="flaticon-share m--hide"></i>
														Update Profile
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
														Messages
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
														Settings
													</a>
												</li>
											</ul>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-portlet__nav-item--last">
													<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
														<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
															<i class="la la-gear"></i>
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
									</div> --}}
									<div class="tab-content">
									<div class="tab-pane active">
										<div class="m-portlet m-portlet--full-height ">
											<div class="m-portlet__head">
												<div class="m-portlet__head-caption">
													<div class="m-portlet__head-title">
														<h3 class="m-portlet__head-text">
															Profil Saya
														</h3>
													</div>
												</div>
												<div class="m-portlet__head-tools">
												</div>
											</div>
											<div class="m-portlet__body">
												<div class="m-widget13">
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Username :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														{{ Auth::user()->username }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Alamat Email :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														{{ Auth::user()->email }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Nama Depan :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														{{ Auth::user()->nm_depan }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Nama Belakang :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														{{ Auth::user()->nm_belakang }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Jenis Kelamin :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														@if($m->gender!=2) 
														laki laki
														@else
														perempuan
														@endif
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Alamat :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{  Auth::user()->alamat }} ,  
															{{DB::table('kelurahan')->where('id', Auth::user()->kelurahan)->value('nama')}} ,
															{{DB::table('kecamatan')->where('id', Auth::user()->kecamatan)->value('nama')}} ,
															{{DB::table('kota_kabupaten')->where('id', Auth::user()->kota)->value('nama')}} ,
															{{DB::table('provinsi')->where('id', Auth::user()->provinsi)->value('nama')}} 
														</span>
														
														
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Nomor Telepon :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														{{  Auth::user()->noTlpn }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Status Pendidikan :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														@if($isCompleted->statusPendidikan!=2) 
														selesai
														@else
														masih pendidikan
														@endif
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Pendidikan Terakhir :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">

														@if($isCompleted->pendidikanTerakhir==1) 
														SD
														@elseif($isCompleted->pendidikanTerakhir==2) 
														SMP
														@elseif($isCompleted->pendidikanTerakhir==3)
														SMA
														@elseif($isCompleted->pendidikanTerakhir==4)
														SMK
														@elseif($isCompleted->pendidikanTerakhir==5)
														D III
														@elseif($isCompleted->pendidikanTerakhir==6)
														S1
														@elseif($isCompleted->pendidikanTerakhir==7)
														S2
														@else
														S3
														@endif
														</span>
													</div>
													
											
													<!-- <div class="m-widget13__action m--align-right">
														<button type="button" class="m-widget__detalis  btn m-btn--pill  btn-accent">
															Detalis
														</button>
														<button type="button" class="btn m-btn--pill    btn-secondary">
															Update
														</button>
													</div> -->
												</div>
											</div>
										</div>
									</div>
									{{-- <div class="tab-pane active" id="m_user_profile_tab_2"></div>
										<div class="tab-pane active" id="m_user_profile_tab_3"></div> --}}
									
								</div>
								
									
								</div>
							</div>
						</div>
					</div>
				</div>
				@endsection