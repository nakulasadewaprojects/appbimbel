@extends('layouts.siswa')
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
									@if(DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('foto')==NULL)
									<img src="{{ url('data_fileSiswa/default_photo_profile.png') }}" height="100px" width="100px" alt="Anda Belum Upload Foto" />
									@else
									<a href="{{ url('localhost/public/data_file/'.$isCompleted->foto) }}" class="thumbnail"> <img src="{{ url('localhost/public/data_file2/'.$isCompleted->foto) }}" alt="Tidak Ada Foto" /></a>
									@endif
								</div>
							</div>
							<div class="m-card-profile__details">
								<span class="m-card-profile__name">
									{{$showmentor->username}}
								</span>
								<a href="" class="m-card-profile__email m-link">
									{{$showmentor->email}}
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
									{{ $showmentor->username }}
								</span>
							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Alamat Email :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->email }}
								</span>
							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Nama Depan :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->nm_depan }}
								</span>
							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Nama Belakang :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->nm_belakang }}
								</span>
							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Jenis Kelamin :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									@if($showmentor->gender!=2)
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
									{{ $showmentor->alamat }} ,
									{{DB::table('kelurahan')->where('id', $showmentor->kelurahan)->value('nama')}} ,
									{{DB::table('kecamatan')->where('id', $showmentor->kecamatan)->value('nama')}} ,
									{{DB::table('kota_kabupaten')->where('id', $showmentor->kota)->value('nama')}} ,
									{{DB::table('provinsi')->where('id', $showmentor->provinsi)->value('nama')}}
								</span>


							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Nomor Telepon :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->noTlpn }}
								</span>
							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Status Pendidikan :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									@if($showmentor->statusPendidikan!=2)
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

									@if($showmentor->pendidikanTerakhir==1)
									SD
									@elseif($showmentor->pendidikanTerakhir==2)
									SMP
									@elseif($showmentor->pendidikanTerakhir==3)
									SMA
									@elseif($showmentor->pendidikanTerakhir==4)
									SMK
									@elseif($showmentor->pendidikanTerakhir==5)
									D III
									@elseif($showmentor->pendidikanTerakhir==6)
									S1
									@elseif($showmentor->pendidikanTerakhir==7)
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
										{{ $showmentor->prodi }}
									</span>
								</div>
							<div class="m-widget13__action m--align-right">
								<!-- <a href="dashboardsiswa"> -->
								<a href="http://localhost/appbimbel/public/formAjukan/{{$showmentor->idmentor}}">
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
</div>

@endsection