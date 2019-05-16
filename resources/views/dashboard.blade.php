@extends('layouts.mentor') 
@section('content')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
				@if (DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('statKomplit')!==6)
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
					<div class="m-subheader-search">
						<h2 class="m-subheader-search__title">
							Cari Jadwal Mengajar
						</h2>
						<form class="m-form">
							<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
								<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="Cari Jadwal">
								<span class="m-input-icon__icon m-input-icon__icon--right">
									<span>
										<i class="la la-puzzle-piece"></i>
									</span>
								</span>
							</div>
							<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-md m-input-icon--right">
								<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="Waktu">
								<span class="m-input-icon__icon m-input-icon__icon--right">
									<span>
										<i class="la la-calendar-check-o"></i>
									</span>
								</span>
							</div>
							<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
							<button type="button" class="btn m-btn--pill m-subheader-search__submit-btn">
								Cari Jadwal
							</button>
						</form>
					</div>
					<div class="m-content">

						<!--begin::Portlet-->
						<div class="m-portlet">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon m--hide">
												<i class="la la-gear"></i>
											</span>
											<h3 class="m-portlet__head-text">
												Form Pengajuan Siswa
											</h3>
										</div>
									</div>
								</div>
								<!--begin::Form-->
								<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="http://localhost/appbimbel/public/ajukan">
									{{ csrf_field() }}
									<div class="m-portlet__body">
										<div class="form-group m-form__group row">
											<label class="col-lg-1 col-form-label">
												Nama :
											</label>
											<div class="col-lg-3">
												<input type="text" class="form-control m-input">
											</div>
											<label class="col-lg-1 col-form-label">
												Alamat:
											</label>
											<div class="col-lg-3">
												<div class="m-input-icon m-input-icon--right">
																										
												</div>
											</div>
											<label class="col-lg-1 col-form-label">
												Nomor Telepon:
											</label>
											<div class="col-lg-3">
												<input type="text" class="form-control m-input">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-lg-1 col-form-label">
												Mulai Bimbel:
											</label>
											<div class="col-lg-3">
											<input class="form-control m-input" type="datetime-local" name="start" id="example-datetime-local-input">
											</div>
											<label class="col-lg-1 col-form-label">
												Akhir Bimbel:
											</label>
											<div class="col-lg-3">
												<div class="m-input-icon m-input-icon--right">
											<input class="form-control m-input" type="datetime-local" name="end" id="example-datetime-local-input">														
													<span class="m-input-icon__icon m-input-icon__icon--right">
													</span>
												</div>
											</div>
											<label class="col-lg-1 col-form-label">
												Durasi:
											</label>
											<div class="col-lg-3">
												<div class="m-input-icon m-input-icon--right">
													<input type="text" class="form-control m-input" placeholder="Durasi BImbel" name="durasi">
												</div>
											</div>
										</div>
										<div class="form-group m-form__group row">
										<label class="col-lg-1 col-form-label">
												Mata Pelajaran:
											</label>
											<div class="col-lg-3">
												<div class="m-input-icon m-input-icon--right">
												<select class="form-control m-select2" id="m_select2_3" name="prodi[]" multiple="multiple">																								
																																																									
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
										<div class="m-form__actions m-form__actions--solid">
											<div class="row">
												<div class="col-lg-5"></div>
												<div class="col-lg-7">
													<button type="button" class="btn btn-primary m-btn m-btn--custom">
														Terima
													</button>
													<button type="button" class="btn btn-danger m-btn m-btn--custom">
														Tolak
													</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!--end::Form-->
							</div>
						</div>
							<!--end::Portlet-->

<!--Begin::Main Portlet-->					
						<div class="row">
							<div class="col-xl-12">
								<!--begin::Portlet-->
								<div class="m-portlet" id="m_portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-map-location"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Calendar
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
														<span>
															<i class="la la-plus"></i>
															<span>
																Add Event
															</span>
														</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div id="m_calendar"></div>
									</div>
								</div>
								<!--end::Portlet-->
							</div>
						</div>
						<!--End::Main Portlet-->						                                    
					</div>
				</div>
			@endsection
			
	