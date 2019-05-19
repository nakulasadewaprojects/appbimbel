@extends('layouts.siswa') 
@section('content')
			<!-- END: Left Aside -->
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
					@if (DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('statusKomplit')!==6)
					<div class="m-alert m-alert--icon alert alert-warning" role="alert">
						<div class="m-alert__icon">
							<i class="la la-warning"></i>
						</div>
						<div class="m-alert__text">
							<strong>
									Luar biasa!
							</strong> Silakan lengkapi profil Anda agar dapat mesen mentor.
						</div>
						<div class="m-alert__actions" style="width: 160px;">
							<a class="btn btn-info btn-sm m-btn m-btn--pill m-btn--wide" href="profilesiswa">Lengkapi Sekarang</a>
						</div>
					</div>
					@endif
				<!-- BEGIN: Subheader -->
				<div class="m-subheader ">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="m-subheader__title ">
								Lihat Profil Saya
							</h3>
						</div>		
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
													@if(DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('fotoProfile')==NULL)
													<img src="{{ url('/data_fileSiswa/default_photo_profile.png') }}" height="100px" width="100px" alt="Anda Belum Upload Foto"/>
													@else
													<a href="{{ url('/data_fileSiswa/'.$isCompleted->fotoProfile) }}" class="thumbnail"><img src="{{ url('/data_fileSiswa2/'.$isCompleted->fotoProfile) }}" alt=""/></a>
													@endif
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
											<a href="myprofilesiswa" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-profile-1"></i>
												<span class="m-nav__link-title">
													<span class="m-nav__link-wrap">
														<span class="m-nav__link-text">
															Lihat Profil Saya
														</span>
									
													</span>
												</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="profilesiswa" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-edit"></i>
												<span class="m-nav__link-title">
													<span class="m-nav__link-wrap">
														<span class="m-nav__link-text">
															Edit Profil Saya
														</span>
										
													</span>
												</span>
											</a>
										</li>
									
									</ul>
									<div class="m-portlet__body-separator"></div>
							
								</div>
							</div>
						</div>
						<div class="col-xl-9 col-lg-8">
							<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">					
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
															Usename :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ Auth::user()->username }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Nama Lengkap :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ Auth::user()->NamaLengkap }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Jenis Kelamin :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
														@if($s->gender!=2) 
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
															{{ Auth::user()->alamat }}
															{{DB::table('kelurahan')->where('id', Auth::user()->kelurahan)->value('nama')}} ,
															{{DB::table('kecamatan')->where('id', Auth::user()->kecamatan)->value('nama')}} ,
															{{DB::table('kota_kabupaten')->where('id', Auth::user()->kota)->value('nama')}} ,
															{{DB::table('provinsi')->where('id', Auth::user()->provinsi)->value('nama')}}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															No. Telepon :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ Auth::user()->NoTlpn }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Email:
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ Auth::user()->email }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Nama Wali :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ $ProfilSiswa->namaWali }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Pendidikan Siswa :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ $ProfilSiswa->pendidikanSiswa }}
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Jenjang :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">

														@if($ProfilSiswa->jenjang==1) 
														SD
														@elseif($ProfilSiswa->jenjang==2) 
														SMP
														@elseif($ProfilSiswa->jenjang==3)
														SMA
														@elseif($ProfilSiswa->jenjang==4)
														SMK
														@elseif($ProfilSiswa->jenjang==5)
														D III
														@elseif($ProfilSiswa->jenjang==6)
														S1
														@elseif($ProfilSiswa->jenjang==7)
														S2
														@else
														S3
														@endif
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Tingkat Pendidikan :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															
															@if($ProfilSiswa->tingkatPendidikan==1)
															Kelas 1 SD, SMP, SMA
															@elseif($ProfilSiswa->tingkatPendidikan==2)
															Kelas 2 SD, SMP, SMA
															@elseif($ProfilSiswa->tingkatPendidikan==3)
															Kelas 3 SD, SMP, SMA
															@elseif($ProfilSiswa->tingkatPendidikan==4)
															Kelas 4 SD
															@elseif($ProfilSiswa->tingkatPendidikan==5)
															Kelas 5 SD
															@else
															Kelas 6 SD
															@endif
														</span>
													</div>
													<div class="m-widget13__item">
														<span class="m-widget13__desc m--align-right">
															Prodi Siswa :
														</span>
														<span class="m-widget13__text m-widget13__text-bolder">
															{{ $ProfilSiswa->prodiSiswa }}
														</span>
													</div>
																								
												</div>
											</div>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-12 ">
							<!--begin:: Widgets/Best Sellers-->
							<div class="m-portlet m-portlet--full-height ">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<h3 class="m-portlet__head-text">
												Data Mentor
											</h3>
										</div>
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
															Elma Khoirotun Nafiah
														</h4>
														<span class="m-widget5__desc">
															B.Indonesia, Matematika
														</span>
														<div class="m-widget5__info">
															<span class="m-widget5__author">
																3 Bulan
															</span>
														</div>
													</div>
													<div class="m-widget5__stats1">
														<span class="m-widget5__number">
															5 Mei- 5 Juli 2019
														</span>
														<br>
														<span class="m-widget5__sales">
															Month
														</span>
													</div>
													<div class="m-widget5__stats2">
														<span class="m-widget5__number">
															Senin- Kamis
														</span>
														<br>
														<span class="m-widget5__votes">
															Day
														</span>
													</div>
												</div>
												<div class="m-widget5__item">
													<div class="m-widget5__pic">
														<img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
													</div>
													<div class="m-widget5__content">
														<h4 class="m-widget5__title">
															Elga Wardatun jannah
														</h4>
														<span class="m-widget5__desc">
															IPA, IPS
														</span>
														<div class="m-widget5__info">
															<span class="m-widget5__author">
															2 Bulan 	
															</span>
														</div>
													</div>
													<div class="m-widget5__stats1">
														<span class="m-widget5__number">
															1 jan- 1 Feb 2020
														</span>
														<br>
														<span class="m-widget5__sales">
															Month
														</span>
													</div>
													<div class="m-widget5__stats2">
														<span class="m-widget5__number">
															Kamis- Minggu
														</span>
														<br>
														<span class="m-widget5__votes">
															Day
														</span>
													</div>
												</div>
												<div class="m-widget5__item">
													<div class="m-widget5__pic">
														<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
													</div>
													<div class="m-widget5__content">
														<h4 class="m-widget5__title">
															Siti Fatimah
														</h4>
														<span class="m-widget5__desc">
															IPA, Matematika, B.Indonesia
														</span>
														<div class="m-widget5__info">
															<span class="m-widget5__author">
															4 Bulan 	
															</span>													
														</div>
													</div>
													<div class="m-widget5__stats1">
														<span class="m-widget5__number">
															1 Mar- 1 Jun 2020
														</span>
														<br>
														<span class="m-widget5__sales">
														Month
														</span>
													</div>
													<div class="m-widget5__stats2">
														<span class="m-widget5__number">
															Senin- Rabu
														</span>
														<br>
														<span class="m-widget5__votes">
															Day
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
				</div>
				
			</div>
			
		</div>
	@endsection