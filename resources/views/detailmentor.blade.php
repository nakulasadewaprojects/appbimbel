@extends('layouts.siswa')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Detail Mentor
				</h3>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="row">
			<div class="col-xl-12">
				<!--begin:: Widgets/Company Summary-->
				<div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
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
							<h5 class="m-widget13__item">
								<center>Data Mentor</center>	
							
							</h5>
							<div class="m-portlet__body-separator"></div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Foto Mentor :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									@if($showmentor->foto==NULL)
									<img src="{{ url('/data_file/default_photo_profile.png') }}" height="200px" width="200px" alt="Anda Belum Upload Foto" />
									@else
									{{-- <img src="{{ url('/data_file2/'.$m->foto) }}" alt="Tidak Ada Foto" /> --}}
									<a href="{{ url('/data_file/'.$showmentor->foto) }}" class="thumbnail"><img width="50px" height="50px" src="{{ url('/data_file2/'.$showmentor->foto) }}" alt=""></a>
									@endif
								</span>
							</div>
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Nama Lengkap :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->nm_depan }} {{ $showmentor->nm_belakang }}
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
							{{-- <div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Nama Depan :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->nm_depan }}
							</span>
						</div> --}}
						{{-- <div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Nama Belakang :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->nm_belakang }}
						</span>
					</div> --}}
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
					<div class="m-portlet__body-separator"></div>
					<h5 class="m-widget13__item">
						<center>Riwayat Mentor</center>	
					</h5>
					<div class="m-portlet__body-separator"></div>
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
							File Ijazah :
						</span>
						<span class="m-widget13__text m-widget13__text-bolder">
							@if($showmentor->foto==NULL)
							<img src="{{ url('/data_file/default_photo_profile.png') }}" height="200px" width="200px" alt="Anda Belum Upload Foto" />
							@else
							{{-- <img src="{{ url('/data_file2/'.$m->foto) }}" alt="Tidak Ada Foto" /> --}}
							<a href="{{ url('/data_file/'.$showmentor->fileIjazah) }}" class="thumbnail"><img width="50px" height="50px" src="{{ url('/data_file2/'.$showmentor->fileIjazah) }}" alt=""></a>
							@endif
						</span>
					</div>
					<div class="m-widget13__item">
						<span class="m-widget13__desc m--align-right">
							Pengalaman Kerja/Mengajar :
						</span>
						<span class="m-widget13__text m-widget13__text-bolder">
							{{ $showmentor->pengalaman }}
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
						<a href="http://localhost/appbimbel/public/formAjukan/{{$showmentor->idmentor}}">
							<button type="button" class="m-widget__detalis  btn m-btn--pill  btn-accent">
								Ajukan
							</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-12">
		<div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<span class="m-portlet__head-icon">
							<i class="la la-puzzle-piece"></i>
						</span>
						<h3 class="m-portlet__head-text">
							Paket Bimbel
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				@if($caripaket==NULL)
				<span class="m-pricing-table-3__description">
					<span>
						<center>Tidak Ada Paket Bimbel</center>
					</span>
				</span>
				@else
				<div class="m-pricing-table-3 m-pricing-table-3--fixed">
					@if($getpaketcount==1)
					<div class="m-pricing-table-1">
						<div class="m-pricing-table-1__items row">
							@foreach($paket as $p)
							<div class="m-pricing-table-1__item col-lg-12">
								<div class="m-pricing-table-1__visual">
									<div class="m-pricing-table-1__hexagon1"></div>
									<div class="m-pricing-table-1__hexagon2"></div>
									<span class="m-pricing-table-1__icon m--font-brand">
										<i class="fa flaticon-piggy-bank"></i>
									</span>
								</div>
								<span class="m-pricing-table-1__price">
									Free
								</span>
								<h2 class="m-pricing-table-1__subtitle">
									1 End Product License
								</h2>
								<span class="m-pricing-table-1__description">
									Lorem ipsum aret
									<br>
									sed do eiusmod
									<br>
									magna siad ali
								</span>
								<div class="m-pricing-table-1__btn">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Purchase
									</button>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@elseif($getpaketcount==2)
					<div class="m-pricing-table-1">
						<div class="m-pricing-table-1__items row">
							@foreach($paket as $p)
							<div class="m-pricing-table-1__item col-lg-6">
								<div class="m-pricing-table-1__visual">
									<div class="m-pricing-table-1__hexagon1"></div>
									<div class="m-pricing-table-1__hexagon2"></div>
									<span class="m-pricing-table-1__icon m--font-brand">
										<i class="fa flaticon-piggy-bank"></i>
									</span>
								</div>
								<span class="m-pricing-table-1__price">
									Free
								</span>
								<h2 class="m-pricing-table-1__subtitle">
									1 End Product License
								</h2>
								<span class="m-pricing-table-1__description">
									Lorem ipsum aret
									<br>
									sed do eiusmod
									<br>
									magna siad ali
								</span>
								<div class="m-pricing-table-1__btn">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Purchase
									</button>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@elseif($getpaketcount==3)
					<div class="m-pricing-table-1">
						<div class="m-pricing-table-1__items row">
							@foreach($paket as $p)
							<div class="m-pricing-table-1__item col-lg-4">
								<div class="m-pricing-table-1__visual">
									<div class="m-pricing-table-1__hexagon1"></div>
									<div class="m-pricing-table-1__hexagon2"></div>
									<span class="m-pricing-table-1__icon m--font-brand">
										<i class="fa flaticon-piggy-bank"></i>
									</span>
								</div>
								<span class="m-pricing-table-1__price">
									Free
								</span>
								<h2 class="m-pricing-table-1__subtitle">
									1 End Product License
								</h2>
								<span class="m-pricing-table-1__description">
									Lorem ipsum aret
									<br>
									sed do eiusmod
									<br>
									magna siad ali
								</span>
								<div class="m-pricing-table-1__btn">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Purchase
									</button>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@elseif($getpaketcount==4)
					<div class="m-pricing-table-1">
						<div class="m-pricing-table-1__items row">
							@foreach($paket as $p)
							<div class="m-pricing-table-1__item col-lg-3">
								<div class="m-pricing-table-1__visual">
									<div class="m-pricing-table-1__hexagon1"></div>
									<div class="m-pricing-table-1__hexagon2"></div>
									<span class="m-pricing-table-1__icon m--font-brand">
										<i class="fa flaticon-piggy-bank"></i>
									</span>
								</div>
								<span class="m-pricing-table-1__price">
									Free
								</span>
								<h2 class="m-pricing-table-1__subtitle">
									1 End Product License
								</h2>
								<span class="m-pricing-table-1__description">
									Lorem ipsum aret
									<br>
									sed do eiusmod
									<br>
									magna siad ali
								</span>
								<div class="m-pricing-table-1__btn">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Purchase
									</button>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@endif
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>

@endsection