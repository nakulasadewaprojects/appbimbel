@extends('layouts.siswa')
@section('content')



<div class="m-grid__item m-grid__item--fluid m-wrapper m-grid m-grid--hor">
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
	<div class="m-content  m-grid__item m-grid__item--fluid">
		<div class="m-grid m-grid--desktop m-grid--ver m-grid--ver-desktop">
		<div class="col-xl-3 m-grid__item m-grid__item.m-grid__item--order-general-3">
			
			<!--begin:: Widgets/Authors Profit-->
			<div class="m-portlet">
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
						<form class="m-form" id="formFilter" method="GET" action="dashboardsiswa" enctype="multipart/form-data">
						<div class="m-widget4__item">
							<div class="m-widget4__info">
								<span class="m-widget4__title">
									Pendidikan Terakhir
								</span>
								<br>
								<div class="col-13">
									<select class="form-control m-input" id="pend" name="pendidikan" type="text">
										<option value="4"  @if(strpos($url, '4' )!== false) selected @endif>Semua Jenjang</option>
										<option value="1" @if(strpos($url,'1' )!== false) selected @endif> SMA, SMK</option>
										<option value="2" @if(strpos($url,'2' )!== false) selected @endif> D3</option>
										<option value="3" @if(strpos($url,'3' )!== false) selected @endif> S1, S2, S3</option>
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
										<input id="bin" name="bin" type="checkbox"  @if(strpos($url,'bin' )!== false) checked @endif>
										Bahasa Indonesia
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="mtk" name="mtk" type="checkbox"  @if(strpos($url,'mtk' )!== false) checked @endif>
										Matematika
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="ipa" name="ipa" type="checkbox"  @if(strpos($url,'ipa' )!== false) checked @endif>
										IPA
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="ips" name="ips" type="checkbox"  @if(strpos($url,'ips' )!== false) checked @endif>
										IPS
										<span></span>
									</label>

								</div>
								<div class="m-checkbox-list">
									<label class="m-checkbox">
										<input id="big" name="big" type="checkbox"  @if(strpos($url,'big' )!== false) checked @endif>
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
											<select class="form-control m-input" id="prov" name="provinsi" type="text">
												<option value="0">Semua Provinsi</option>
												@foreach ($p as $a)
												<option value="{{ $a->id }}" @if(strpos($url, 'provinsi=$a->id'  )) selected @endif> {{$a->nama}}</option>
												@endforeach

											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input">

										</label>
										<div class="col-12">
											<select class="form-control m-input" name="kabupaten" type="text" id="kab">
												<option value="0">Semua Kabupaten</option>
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
											<select class="form-control m-input" name="kecamatan" type="text" id="kec">
												<option value="0">Semua Kecamatan </option>
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
											<select class="form-control m-input" name="kelurahan" type="text" id="kel">
												<option value="0">Semua Kelurahan </option>
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
						</form>
					</div>
				</div>
			
			<!--end:: Widgets/Authors Profit-->
		</div>
	</div>


			<div class="m-grid__item m-grid__item.m-grid__item--order-general-9">
				<!--begin:: Widgets/Best Sellers-->
				<div class="row">
					<div class="col-xl-9">
						<div class="m-portlet  ">
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
								<!--begin::Content-->
								<div class="tab-content">
									<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
										<!--begin::m-widget5-->
										<div class="m-widget5">

											@foreach($mentor as $m)
											<div class="m-widget5__item">
												<div class="m-widget5__pic">
													<img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt="">
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
											{{-- {{ $mentor->links() }} --}}

											<!--end::m-widget5-->
										</div>
									</div>
									<!--end::Content-->
								</div>
							</div>
							<!--end:: Widgets/Best Sellers-->
						</div>
					</div>
					<div class="col-xl-9">
									<div class="m-portlet  ">
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
								@if($grup!==NULL)
															@foreach($grup as $m)
															<div class="m-widget5__item">
																<div class="m-widget5__pic">
																	<img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt="">
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
																	<button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">
																		Detail
																	</button>
																</div>
															</div>
															@endforeach
														@else
														 Tidak Ada Hasil Pencarian
														@endif
															<!-- {{-- {{ $mentor->links() }} --}} -->
															
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


	</div>
</div>
</div>
@endsection