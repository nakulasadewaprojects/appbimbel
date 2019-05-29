@extends('layouts.siswa')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
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
								Data Mentor
							</h5>
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
					<h5 class="m-widget13__item">
						Riwayat Mentor
					</h5>
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
			<div class="m-portlet__body m-portlet__body--no-padding">
				<div class="m-pricing-table-2">
					<div class="m-pricing-table-2__head">
						<div class="m-pricing-table-2__title m--font-light">
							<h1>
								Data Paket @if($getpaketcount==0)Kosong @endif
							</h1>
						</div>
						<div class="btn-group nav m-btn-group m-btn-group--pill m-btn-group--air" role="group">
							<button type="button" class="btn m-btn--pill  active m-btn--wide m-btn--uppercase m-btn--bolder" data-toggle="tab" href="#m-pricing-table_content1" role="tab" aria-expanded="true">
								Paket
							</button>
							<button type="button" class="btn m-btn--pill  m-btn--wide m-btn--uppercase m-btn--bolder" data-toggle="tab" href="#m-pricing-table_content2" role="tab" aria-expanded="false">
								Bimbel
							</button>
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="m-pricing-table_content1" aria-expanded="true">
							<div class="m-pricing-table-2__content">
								@if($getpaketcount==1)
								<div class="m-pricing-table-2__container">
									<div class="m-pricing-table-2__items row">
										@foreach($paket as $p)
										<div class=col-4></div>
										<div class="m-pricing-table-2__item col-lg-4">
											<div class="m-pricing-table-2__visual">
												<div class="m-pricing-table-2__hexagon"></div>
												<span class="m-pricing-table-2__icon m--font-info">
													<i class="fa flaticon-confetti"></i>
												</span>
											</div>
											<h2 class="m-pricing-table-2__subtitle">
												{{$p->nmpaket}}
											</h2>
											<div class="m-pricing-table-2__features">
												<span>
													Bimbel selama {{$p->durasi}} bulan
												</span>
												<span>
													@if($p->hari!=NULL)
													Hari {{$p->hari}}
													@else
													Hari Tentukan sendiri
													@endif
												</span>
												<span>
													@if($p->wkt_mulai!=NULL)
													Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
													@else
													Jam Tentukan Sendiri
													@endif
												</span>
												<span>
													{{$p->keterangan}}
												</span>
											</div>
											<span class="m-pricing-table-2">
												Rp.
											</span>
											<span class="m-pricing-table-2__price">
												{{$p->harga}}
											</span>
											<div class="m-pricing-table-1__btn">
												<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
													<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
														Ajukan
													</button>
												</a>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								@elseif($getpaketcount==2)
								<div class="m-pricing-table-2__container">
									<div class="m-pricing-table-2__items row">
										@foreach($paket as $p)
										<div class="col-1"></div>
										<div class="m-pricing-table-2__item col-lg-5">
											<div class="m-pricing-table-2__visual">
												<div class="m-pricing-table-2__hexagon"></div>
												<span class="m-pricing-table-2__icon m--font-info">
													<i class="fa flaticon-confetti"></i>
												</span>
											</div>
											<h2 class="m-pricing-table-2__subtitle">
												{{$p->nmpaket}}
											</h2>
											<div class="m-pricing-table-2__features">
												<span>
													Bimbel selama {{$p->durasi}} bulan
												</span>
												<span>
													@if($p->hari!=NULL)
													Hari {{$p->hari}}
													@else
													Hari Tentukan sendiri
													@endif
												</span>
												<span>
													@if($p->wkt_mulai!=NULL)
													Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
													@else
													Jam Tentukan Sendiri
													@endif
												</span>
												<span>
													{{$p->keterangan}}
												</span>
											</div>
											<span class="m-pricing-table-2">
												Rp.
											</span>
											<span class="m-pricing-table-2__price">
												{{$p->harga}}
											</span>
											<div class="m-pricing-table-1__btn">
												<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
													<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
														Ajukan
													</button>
												</a>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								@elseif($getpaketcount==3)
								<div class="m-pricing-table-2__container">
									<div class="m-pricing-table-2__items row">
										@foreach($paket as $p)
										<div class="m-pricing-table-2__item col-lg-4">
											<div class="m-pricing-table-2__visual">
												<div class="m-pricing-table-2__hexagon"></div>
												<span class="m-pricing-table-2__icon m--font-info">
													<i class="fa flaticon-confetti"></i>
												</span>
											</div>
											<h2 class="m-pricing-table-2__subtitle">
												{{$p->nmpaket}}
											</h2>
											<div class="m-pricing-table-2__features">
												<span>
													Bimbel selama {{$p->durasi}} bulan
												</span>
												<span>
													@if($p->hari!=NULL)
													Hari {{$p->hari}}
													@else
													Hari Tentukan sendiri
													@endif
												</span>
												<span>
													@if($p->wkt_mulai!=NULL)
													Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
													@else
													Jam Tentukan Sendiri
													@endif
												</span>
												<span>
													{{$p->keterangan}}
												</span>
											</div>
											<span class="m-pricing-table-2">
												Rp.
											</span>
											<span class="m-pricing-table-2__price">
												{{$p->harga}}
											</span>
											<div class="m-pricing-table-1__btn">
												<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
													<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
														Ajukan
													</button>
												</a>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
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
								Rp. {{$p->harga}}
								Free
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->nmpaket}}
							</h2>
							<span class="m-pricing-table-1__description">
								Bimbel selama {{$p->durasi}} bulan
								<br>
								@if($p->hari!=NULL)
								Hari {{$p->hari}}
								@else
								Hari Tentukan sendiri
								@endif
								<br>
								@if($p->wkt_mulai!=NULL)
								Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
								@else
								Jam Tentukan Sendiri
								@endif
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->keterangan}}
							</h2>
							<div class="m-pricing-table-1__btn">
								<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Ajukan
									</button>
								</a>
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
								Rp. {{$p->harga}}
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->nmpaket}}
							</h2>
							<span class="m-pricing-table-1__description">
								Bimbel selama {{$p->durasi}} bulan
								<br>
								@if($p->hari!=NULL)
								Hari {{$p->hari}}
								@else
								Hari Tentukan sendiri
								@endif
								<br>
								@if($p->wkt_mulai!=NULL)
								Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
								@else
								Jam Tentukan Sendiri
								@endif
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->keterangan}}
							</h2>
							<div class="m-pricing-table-1__btn">
								<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Ajukan
									</button>
								</a>
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
								Rp. {{$p->harga}}
								Free
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->nmpaket}}
							</h2>
							<span class="m-pricing-table-1__description">
								Bimbel selama {{$p->durasi}} bulan
								<br>
								@if($p->hari!=NULL)
								Hari {{$p->hari}}
								@else
								Hari Tentukan sendiri
								@endif
								<br>
								@if($p->wkt_mulai!=NULL)
								Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
								@else
								Jam Tentukan Sendiri
								@endif
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->keterangan}}
							</h2>
							<div class="m-pricing-table-1__btn">
								<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Ajukan
									</button>
								</a>
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
								Rp. {{$p->harga}}
								Free
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->nmpaket}}
							</h2>
							<span class="m-pricing-table-1__description">
								Bimbel selama {{$p->durasi}} bulan
								<br>
								@if($p->hari!=NULL)
								Hari {{$p->hari}}
								@else
								Hari Tentukan sendiri
								@endif
								<br>
								@if($p->wkt_mulai!=NULL)
								Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
								@else
								Jam Tentukan Sendiri
								@endif
							</span>
							<h2 class="m-pricing-table-1__subtitle">
								{{$p->keterangan}}
							</h2>
							<div class="m-pricing-table-1__btn">
								<a href="http://localhost/appbimbel/public/formAjukanPaket/{{$p->NoIDMentor}}/{{$p->idpaket}}">
									<button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">
										Ajukan
									</button>
								</a>
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