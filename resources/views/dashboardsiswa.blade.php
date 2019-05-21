@extends('layouts.siswa')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper m-grid m-grid--hor">
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
	{{-- <div class="m-subheader-search">
		<h2 class="m-subheader-search__title">
			Cari Mentor
		</h2>
		<form class="m-form">
			<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
				<span class="m-input-icon__icon m-input-icon__icon--right">
					<span>
					</span>
				</span>
			</div>
			<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
		</form>
	</div> --}}

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/bimbel.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/belajar.jpg" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/bimbel.jpg" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">

			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_1">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Filter Mentor
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="" data-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
										<i class="la la-angle-down"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body @if($grup=='iwak') collapse @else @endif">
					<form id="formFilter" method="GET" action="dashboardsiswa" enctype="multipart/form-data">
							<div class="row m-row--no-padding m-row--col-separator-xl">						
								<div class="col-xl-4">
									<div class="m-widget14">
										<div class="m-widget14__header m--margin-bottom">
											<span class="m-widget14__title">
												Pendidikan Mentor
											</span>
											<span class="m-widget14__title">
												<div class="form-group m-form__group row">
												<div class="col-10">
													<select onchange="myFunction()" class="form-control m-input" id="pend" name="pendidikan"
														type="text">
														<option value="4" @if(strpos($url,'4' )!==false) selected
															@endif>Semua Jenjang</option>
														<option value="1" @if(strpos($url,'1' )!==false) selected
															@endif> SMA, SMK</option>
														<option value="2" @if(strpos($url,'2' )!==false) selected
															@endif> D3</option>
														<option value="3" @if(strpos($url,'3' )!==false) selected
															@endif> S1, S2, S3</option>
													</select>
												</div>
												</div>
											</span>
										</div>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="m-widget14">
										<div class="m-widget14__header m--margin-bottom">
											<span class="m-widget14__title">
												Mata Pelajaran
											</span>
											<div class="m-checkbox-list">
												<label class="m-checkbox">
													<input class="myCheckBox" value="true" id="bin" name="bin" type="checkbox" @if(strpos($url,'bin'
														)!==false) checked @endif>
													Bahasa Indonesia
													<span></span>
												</label>
											</div>
											<div class="m-checkbox-list">
												<label class="m-checkbox">
													<input class="myCheckBox" value="true" id="mtk" name="mtk" type="checkbox" @if(strpos($url,'mtk'
														)!==false) checked @endif>
													Matematika
													<span></span>
												</label>
											</div>
											<div class="m-checkbox-list">
												<label class="m-checkbox">
													<input class="myCheckBox"  value="true" id="ipa" name="ipa" type="checkbox" @if(strpos($url,'ipa'
														)!==false) checked @endif>
													IPA
													<span></span>
												</label>
											</div>
											<div class="m-checkbox-list">
												<label class="m-checkbox">
													<input class="myCheckBox" value="true" id="ips"  name="ips" type="checkbox" @if(strpos($url,'ips'
														)!==false) checked @endif>
													IPS
													<span></span>
												</label>
											</div>
											<div class="m-checkbox-list">
												<label class="m-checkbox">
													<input class="myCheckBox" value="true" id="big" name="big" type="checkbox" @if(strpos($url,'big'
														)!==false) checked @endif>
													Bahasa Inggris
													<span></span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="m-widget14">
										<div class="m-widget14__header m--margin-bottom">
											<span class="m-widget14__title">
												Alamat
											</span>
											<div class="m-form__group form-group">
												<div class="form-group m-form__group row">
													<div class="col-10">
														<select class="form-control m-input" id="prov" name="provinsi"
															type="text">
															<option value="0">Semua Provinsi</option>
															@foreach ($p as $a)
															<option value="{{ $a->id }}"> {{$a->nama}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input">
													</label>
													<div class="col-10">
														<select class="form-control m-input" name="kabupaten"
															type="text" id="kab">
															<option value="0">Semua Kabupaten</option>
														</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input">
													</label>
													<div class="col-10">
														<select class="form-control m-input" name="kecamatan"
															type="text" id="kec">
															<option value="0">Semua Kecamatan </option>
														</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input">
													</label>
													<div class="col-10">
														<select class="form-control m-input" name="kelurahan"
															type="text" id="kel">
															<option value="0">Semua Kelurahan </option>
														</select>
													</div>
												</div>
												<button type="submit" id="btn" class="btn">
													Cari
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			@if($grup=='iwak')
			<div class="col-xl-12">
			<div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Rekomendasi Mentor Sesuai Prodi Anda
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
								<div class="m-widget5">
									@if($isCompleted->prodiSiswa==NULL)
									Rekomendasi mentor akan muncul setelah data Anda lengkapi
									@else
									@foreach($mentor as $m)
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
												@if($m->foto==NULL)
												<img src="{{ url('/data_fileSiswa/default_photo_profile.png') }}" height="100px" width="100px" alt="Anda Belum Upload Foto" />
												@else
												<img src="{{ url('/data_file2/'.$m->foto) }}" alt="Tidak Ada Foto" />
												@endif
											</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												{{$m->nm_depan}}
											</h4>
											<span class="m-widget5__desc m--font-info">
												{{$m->prodi}}
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Alamat: {{$m->alamat}}
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<a href="detailmentor/{{$m->idmentor}}">
												<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
													Detail
												</button>
											</a>
										</div>
									</div>
									@endforeach
									{{ $mentor->links() }}
									@endif
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
			@if($grup!=='iwak')
			<div class="col-xl-12">
				<div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Hasil Pencarian
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
										@if($isCompleted->prodiSiswa==NULL)
										Hasil pencarian mentor akan muncul setelah data Anda lengkapi
										@elseif($grup->isEmpty())
										Tidak Ada Hasil Pencarian
										@else
									@foreach($grup as $m)
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
												@if($m->foto==NULL)
												<img src="{{ url('/data_fileSiswa/default_photo_profile.png') }}" height="100px" width="100px" alt="Anda Belum Upload Foto" />
												@else
												<img src="{{ url('/data_file2/'.$m->foto) }}" alt="Tidak Ada Foto" />
												@endif</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												{{$m->nm_depan}}
											</h4>
											<span class="m-widget5__desc m--font-info">
												{{$m->prodi}}
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Alamat: {{$m->alamat}}
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<a href="detailmentor/{{$m->idmentor}}">
											<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
												Detail
											</button>
											</a>
										</div>
									</div>
									@endforeach
									
									@endif
									
									<!--end::m-widget5-->
								</div>
								@if($grup!=='iwak')
								{{ $grup->links() }}
								@else
								@endif
							</div>
							<!--end::Content-->
						</div>
					</div>
					<!--end:: Widgets/Best Sellers-->
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
</div>
@endsection