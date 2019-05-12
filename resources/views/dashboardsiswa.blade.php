@extends('layouts.siswa')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	@if (DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('statusKomplit')!==4)
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
	<div class="m-subheader-search">
		<h2 class="m-subheader-search__title">
			Cari Mentor
		</h2>
		<form class="m-form">
			<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
				<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="MatPel">
				<span class="m-input-icon__icon m-input-icon__icon--right">
					<span>
						<i class="la la-puzzle-piece"></i>
					</span>
				</span>
			</div>
			<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
			<button type="button" class="btn m-btn--pill m-subheader-search__submit-btn">
				Cari
			</button>
		</form>
	</div>
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Daftar Mentor
				</h3>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="col-xl-6 col-lg-4">
			<div class="m-portlet m-portlet--full-height  ">
				<div class="m-portlet__body">
					<div class="m-card-profile">
						<form class="m-form" method="GET" action="filter/get" enctype="multipart/form-data">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">
									Pendidikan Terakhir
								</label>
								<div class="col-7">
									<select class="form-control m-input" name="pendidikan" type="text">
										<option value="4">Semua Jenjang Pendidikan</option>
										<option value="1"> SMA, SMK</option>
										<option value="2"> D3</option>										
										<option value="3"> S1, S2, S3</option>



									</select>
								</div>
							</div>
							
							<div class="m-form__group form-group">
								<label for="">
									Mata Pelajaran
								</label>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="bhsIndonesia" name="bin" type="checkbox">
										Bahasa Indonesia
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="mtk" name="mtk" type="checkbox">
										Matematika
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="ipa" name="ipa" type="checkbox">
										IPA
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="ips" name="ips" type="checkbox">
										IPS
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="bhsInggris" name="big" type="checkbox">
										Bahasa Inggris
										<span></span>
									</label>

								</div>
							
							</div>
							<div class="m-form__group form-group">
								<label for="">
									Alamat
								</label>
													<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Provinsi
													</label>
													<div class="col-7">
													<select class="form-control m-input" name="provinsi" type="text">
															<option value="0">Semua Provinsi</option>
															@foreach ($p as $a)
															<option value="{{ $a->id }}" {{ Auth::user()->provinsi ==  $a->id  ? 'selected' : ''}}> {{$a->nama}}</option>																																																															
															@endforeach
															
													</select>
													</div>
													</div>
													<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Kabupaten
													</label>
													<div class="col-7">
													<select class="form-control m-input" name="kabupaten" type="text" id="kabupaten">															
															<option value="0">Semua Kabupaten</option>
															@foreach ($b as $a)																
															<option value="{{ $a->id }}"{{ Auth::user()->kota ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>																																		
															@endforeach
													</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Kecamatan
													</label>
													<div class="col-7">
													<select class="form-control m-input" name="kecamatan" type="text" id="kecamatan">
															<option value="0">Semua Kecamatan </option>
															@foreach ($c as $a)
															<option value="{{ $a->id }}"{{ Auth::user()->kecamatan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>																																																	
															@endforeach
													</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Kelurahan
													</label>
													<div class="col-7">
														<select class="form-control m-input" name="kelurahan" type="text" id="kelurahan">
															<option value="0">Semua Kelurahan </option>
										 					@foreach ($d as $a)
															<option value="{{ $a->id }}"{{ Auth::user()->kelurahan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
															@endforeach
														</select>
													</div>
												</div>
												</div>
							
							</div>
							<button type="submit" class="btn m-btn--pill">
								Cari
							</button>
						</form>
					</div>
					<div class="m-portlet__body-separator"></div>

				</div>
			</div>
		</div>
		<div class="row">

			@foreach($mentor as $dm)

			<div class="col-xl-3 col-lg-4">
				<div class="m-portlet m-portlet--full-height  ">
					<div class="m-portlet__body">
						<div class="m-card-profile">
							<div class="m-card-profile__title m--hide">
								Your Profile
							</div>
							<div class="m-card-profile__pic">
								<div class="m-card-profile__pic-wrapper">
									<img src="{{ url('/data_file/'.$dm->foto) }}" alt="" width="100px" height="100px" />
								</div>
							</div>
							<div class="m-card-profile__details">
								<span class="m-card-profile__name">
									{{$dm->username}}
									{{ $dm->nm_depan }} {{ $dm->nm_belakang }}
								</span>
								<a href="" class="m-card-profile__email m-link">
									{{ $dm->alamat  }}
								</a>
								{{$dm->prodi}}
							</div>
						</div>

						<div class="m-portlet__body-separator"></div>

					</div>
				</div>
			</div>
			@endforeach



		</div>
	</div>
</div>
</div>
@endsection