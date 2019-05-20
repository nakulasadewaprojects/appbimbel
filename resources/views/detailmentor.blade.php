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
							<div class="m-widget13__item">
								<span class="m-widget13__desc m--align-right">
									Pengalaman Kerja/Mengajar :
								</span>
								<span class="m-widget13__text m-widget13__text-bolder">
									{{ $showmentor->pengalaman }}
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
			<div class="m-portlet">
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
					<div class="m-pricing-table-3 m-pricing-table-3--fixed">
						<div class="m-pricing-table-3__items">
							<div class="row m-row--no-padding">
								<div class="m-pricing-table-3__item col-lg-4">
									<div class="m-pricing-table-3__wrapper">
										<h3 class="m-pricing-table-3__title">
											Basic
										</h3>
										<span class="m-pricing-table-3__price m-pricing-table-3__price--padding">
											Free
										</span>
										<br>
										<span class="m-pricing-table-3__description">
											<span>
												Lorem ipsum dolor sit amet adipiscing elit
											</span>
											<br>
											<span>
												sed do eiusmod tempors labore et dolore
											</span>
											<br>
											<span>
												magna siad enim aliqua
											</span>
											<br>
										</span>
										<div class="m-pricing-table-3__btn">
											<button type="button" class="btn m-btn--pill  btn-brand m-btn--wide m-btn--uppercase m-btn--bolder m-btn--lg">
												Download
											</button>
										</div>
									</div>
								</div>
								<div class="m-pricing-table-3__item m-pricing-table-3__item--focus m--bg-brand col-lg-4">
									<div class="m-pricing-table-3__wrapper">
										<h3 class="m-pricing-table-3__title m--font-light">
											Professional
										</h3>
										<span class="m-pricing-table-3__price">
											<span class="m-pricing-table-3__label">
												$
											</span>
											<span class="m-pricing-table-3__number m--font-light">
												29
											</span>
											<span class="m-pricing-table-3__text">
												/&nbsp;&nbsp;Per Installation
											</span>
										</span>
										<br>
										<span class="m-pricing-table-3__description">
											<span>
												Lorem ipsum dolor sit amet adipiscing elit
											</span>
											<br>
											<span>
												sed do eiusmod tempors labore et dolore
											</span>
											<br>
											<span>
												magna siad enim aliqua
											</span>
											<br>
										</span>
										<div class="m-pricing-table-3__btn">
											<button type="button" class="btn m-btn--pill  btn-light m-btn--label-brand m-btn--wide m-btn--uppercase m-btn--bolder m-btn--lg">
												Purchase
											</button>
										</div>
									</div>
								</div>
								<div class="m-pricing-table-3__item col-lg-4">
									<div class="m-pricing-table-3__wrapper">
										<h3 class="m-pricing-table-3__title">
											Extended
										</h3>
										<span class="m-pricing-table-3__price">
											<span class="m-pricing-table-3__label">
												$
											</span>
											<span class="m-pricing-table-3__number">
												99
											</span>
											<span class="m-pricing-table-3__text">
												/&nbsp;&nbsp;Per Installation
											</span>
										</span>
										<br>
										<span class="m-pricing-table-3__description">
											<span>
												Lorem ipsum dolor sit amet adipiscing elit
											</span>
											<br>
											<span>
												sed do eiusmod tempors labore et dolore
											</span>
											<br>
											<span>
												magna siad enim aliqua
											</span>
											<br>
										</span>
										<div class="m-pricing-table-3__btn">
											<button type="button" class="btn m-btn--pill  btn-brand m-btn--wide m-btn--uppercase m-btn--bolder m-btn--lg">
												Purchase
											</button>
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
	</div>	
</div>
</div>

@endsection