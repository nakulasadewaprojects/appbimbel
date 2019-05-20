@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
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
		</div>
	</div>
	<div class="m-content">
		<div class="row">
			<div class="col-xl-3 col-lg-4">
				<div class="m-portlet">
					<div class="m-portlet__body">
						<div class="m-card-profile">
							<div class="m-card-profile__title m--hide">
								Your Profile
							</div>
							<div class="m-card-profile__pic">
								<div class="m-card-profile__pic-wrapper">
									@if(DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('foto')==NULL)
									<img src="{{ url('/data_fileSiswa/default_photo_profile.png') }}" height="100px" width="100px" alt="Anda Belum Upload Foto" />
									@else
									<a href="{{ url('/data_file/'.$isCompleted->foto) }}" class="thumbnail"> <img src="{{ url('/data_file2/'.$isCompleted->foto) }}" alt="Tidak Ada Foto" /></a>
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
								<a href="myProfile" class="m-nav__link">
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
								<a href="profile" class="m-nav__link">
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
							<div class="m-portlet m-portlet--success m-portlet--head-solid-bg">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<h3 class="m-portlet__head-text">
												Profil Saya
											</h3>
										</div>
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
												{{ Auth::user()->alamat }} ,
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
												{{ Auth::user()->noTlpn }}
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
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Prodi Mentor :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ $isCompleted->prodi }}
											</span>
										</div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Pengalaman Kerja/Mengajar :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ $isCompleted->pengalaman }}
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
	</div>
</div>
@endsection