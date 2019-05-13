@extends('layouts.mentor') 
@section('content')
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<!-- BEGIN: Subheader -->
				<div class="m-subheader ">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="m-subheader__title ">
								Detail Mentor 
							</h3>
						</div>
					</div>
				</div>
				<!-- END: Subheader -->
				<div class="m-content">
					<div class="row">
						<div class="col-xl-3 col-lg-4">
							<div class="m-portlet m-portlet--full-height  ">
								<br><br>
								<div class="m-portlet__body">
									<div class="m-card-profile">
										<div class="m-card-profile__title m--hide">
											Your Profile
										</div>
										<div class="m-card-profile__pic">
											<div class="m-card-profile__pic-wrapper">
												<img src="assets/app/media/img/users/user4.jpg" alt="" />
											</div>
										</div>
										<div class="m-card-profile__details">
											<span class="m-card-profile__name">
												{{$isCompleted->username}}
											</span>
											<a href="" class="m-card-profile__email m-link">
												{{$isCompleted->email}}
											</a>
										</div>
									</div>									
								</div>
							</div>
						</div>
						<div class="col-xl-9">
								<!--begin:: Widgets/Company Summary-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Detail
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
												{{ $isCompleted->username }}
												</span>
											</div>
											<div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Alamat Email :
												</span>
												<span class="m-widget13__text m-widget13__text-bolder">
												{{ $isCompleted->email }}
												</span>
											</div>
											<div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Nama Depan :
												</span>
												<span class="m-widget13__text m-widget13__text-bolder">
												{{ $isCompleted->nm_depan }}
												</span>
											</div>
											<div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Nama Belakang :
												</span>
												<span class="m-widget13__text m-widget13__text-bolder">
												{{ $isCompleted->nm_belakang }}
												</span>
											</div>
											<div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Jenis Kelamin :
												</span>
												<span class="m-widget13__text m-widget13__text-bolder">
												@if($isCompleted->gender!=2) 
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
													{{  $isCompleted->alamat }} ,  
													{{DB::table('kelurahan')->where('id', $isCompleted->kelurahan)->value('nama')}} ,
													{{DB::table('kecamatan')->where('id', $isCompleted->kecamatan)->value('nama')}} ,
													{{DB::table('kota_kabupaten')->where('id', $isCompleted->kota)->value('nama')}} ,
													{{DB::table('provinsi')->where('id', $isCompleted->provinsi)->value('nama')}} 
												</span>
												
												
											</div>
											<div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Nomor Telepon :
												</span>
												<span class="m-widget13__text m-widget13__text-bolder">
												{{  $isCompleted->noTlpn }}
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
											<div class="m-widget13__action m--align-right">
												<a href="dashboardsiswa">
													<button type="button" class="m-widget__detalis  btn m-btn--pill  btn-accent">
														Ajukan
													</button>
												</div>
									
											
											
							</div>
						</div>
								</div>
								<!--end:: Widgets/Company Summary-->
							</div>
					</div>
				</div>
			</div>
		
			@endsection
