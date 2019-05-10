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
					Data Mentor
				</h3>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="row">
			<div class="col-xl-3">
				<!--begin:: Widgets/Authors Profit-->
				<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Filter Mentor
								</h3>
							</div>
						</div>

					</div>
					<div class="m-portlet__body">
						<div class="m-widget4">
							<div class="m-widget4__item">
								<div class="m-widget4__info">
									<span class="m-widget4__title">
										Pendidikan Terakhir
									</span>
									<br>
									<div class="col-13">
										<select class="form-control m-input" name="pendidikan" type="text">
											<option value="3">Semua Jenjang</option>
											<option value="1"> SMA, SMK, D3</option>
											<option value="2"> S1, S2, S3</option>
										</select>
									</div>
								</div>
							</div>
							<div class="m-widget4__item">

								<div class="m-widget4__info">
									<span class="m-widget4__title">
										Mata Pelajaran
									</span>
									<br>
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

							</div>

							<div class="m-widget4__item">
								<div class="m-widget4__info">
									<span class="m-widget4__title">
										Alamat
									</span>
									<br>
									<div class="m-form__group form-group">
										<div class="form-group m-form__group row">
											<div class="col-12">
												<select class="form-control m-input" name="provinsi" type="text">
													<option value="0">Pilih Provinsi</option>
													@foreach ($p as $a)
													<option value="{{ $a->id }}" {{ Auth::user()->provinsi ==  $a->id  ? 'selected' : ''}}> {{$a->nama}}</option>
													@endforeach

												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input">

											</label>
											<div class="col-12">
												<select class="form-control m-input" name="kabupaten" type="text" id="kabupaten">
													<option value="0">Pilih Kabupaten</option>
													@foreach ($b as $a)
													<option value="{{ $a->id }}" {{ Auth::user()->kota ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input">

											</label>
											<div class="col-12">
												<select class="form-control m-input" name="kecamatan" type="text" id="kecamatan">
													<option value="0">Pilih Kecamatan </option>
													@foreach ($c as $a)
													<option value="{{ $a->id }}" {{ Auth::user()->kecamatan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input">

											</label>
											<div class="col-12">
												<select class="form-control m-input" name="kelurahan" type="text" id="kelurahan">
													<option value="0">Pilih Kelurahan </option>
													@foreach ($d as $a)
													<option value="{{ $a->id }}" {{ Auth::user()->kelurahan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<button type="submit" class="btn">
											Cari
										</button>
									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
				<!--end:: Widgets/Authors Profit-->
			</div>
			<div class="col-xl-9">
				<!--begin:: Widgets/Best Sellers-->
				<div class="m-portlet m-portlet--full-height ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Hasil
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
												Great Logo Designn
											</h4>
											<span class="m-widget5__desc">
												Make Metronic Great Again.Lorem Ipsum Amet
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Author:
												</span>
												<span class="m-widget5__info-label">
													author:
												</span>
												<span class="m-widget5__info-author-name">
													Fly themes
												</span>
												<span class="m-widget5__info-label">
													Released:
												</span>
												<span class="m-widget5__info-date m--font-info">
													23.08.17
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<a href="detailmentor">
												<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
													Detail
												</button>
											</a>
										</div>
									</div>

									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Branding Mockup
											</h4>
											<span class="m-widget5__desc">
												Make Metronic Great Again.Lorem Ipsum Amet
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Author:
												</span>
												<span class="m-widget5__info-author m--font-info">
													Fly themes
												</span>
												<span class="m-widget5__info-label">
													Released:
												</span>
												<span class="m-widget5__info-date m--font-info">
													23.08.17
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
												Detail
											</button>
										</div>
									</div>
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Awesome Mobile App
											</h4>
											<span class="m-widget5__desc">
												Make Metronic Great Again.Lorem Ipsum Amet
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Author:
												</span>
												<span class="m-widget5__info-author m--font-info">
													Fly themes
												</span>
												<span class="m-widget5__info-label">
													Released:
												</span>
												<span class="m-widget5__info-date m--font-info">
													23.08.17
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
												Detail
											</button>
										</div>
									</div>
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Awesome Mobile App
											</h4>
											<span class="m-widget5__desc">
												Make Metronic Great Again.Lorem Ipsum Amet
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Author:
												</span>
												<span class="m-widget5__info-author m--font-info">
													Fly themes
												</span>
												<span class="m-widget5__info-label">
													Released:
												</span>
												<span class="m-widget5__info-date m--font-info">
													23.08.17
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
												Detail
											</button>
										</div>
									</div>
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Awesome Mobile App
											</h4>
											<span class="m-widget5__desc">
												Make Metronic Great Again.Lorem Ipsum Amet
											</span>
											<div class="m-widget5__info">
												<span class="m-widget5__author">
													Author:
												</span>
												<span class="m-widget5__info-author m--font-info">
													Fly themes
												</span>
												<span class="m-widget5__info-label">
													Released:
												</span>
												<span class="m-widget5__info-date m--font-info">
													23.08.17
												</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
											<br>
											<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
												Detail
											</button>
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
											<option value="3">Semua Jenjang Pendidikan</option>
											<option value="1"> SMA, SMK, D3</option>
											<option value="2"> S1, S2, S3</option>
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
										Pilih Alamat
									</label>
									<div class="form-group m-form__group row">
										<label for="example-text-input">

										</label>
										<div class="col-5">
											<select class="form-control m-input" name="provinsi" type="text">
												<option value="0">Pilih Provinsi</option>
												@foreach ($p as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->provinsi ==  $a->id  ? 'selected' : ''}}> {{$a->nama}}</option>
												@endforeach

											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input">

										</label>
										<div class="col-5">
											<select class="form-control m-input" name="kabupaten" type="text" id="kabupaten">
												<option value="0">Pilih Kabupaten</option>
												@foreach ($b as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->kota ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input">

										</label>
										<div class="col-5">
											<select class="form-control m-input" name="kecamatan" type="text" id="kecamatan">
												<option value="0">Pilih Kecamatan </option>
												@foreach ($c as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->kecamatan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input">

										</label>
										<div class="col-5">
											<select class="form-control m-input" name="kelurahan" type="text" id="kelurahan">
												<option value="0">Pilih Kelurahan </option>
												@foreach ($d as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->kelurahan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
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
</div>
@endsection