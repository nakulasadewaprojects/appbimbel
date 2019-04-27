@extends('layouts.siswa') 
@section('content')
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">
									Edit Profil Sayang
								</h3>
							</div>
							
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="row">
							<div class="col-xl-3 col-lg-4">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__title m--hide">
												Your Profile
											</div>
											<div class="m-card-profile__pic">
												<div class="m-card-profile__pic-wrapper">
													<img src="assets/app/media/img/users/user4.jpg" alt=""/>
												</div>
											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">
													{{ Auth::user()->username }}
												</span>
												<a href="" class="m-card-profile__email m-link">
													{{ Auth::user()->email }} 
												</a>
											</div>
										</div>
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section m--hide">
												<span class="m-nav__section-text">
													Section
												</span>
											</li>
											<li class="m-nav__item">
												<a href="myprofilesiswa" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">
																Lihat Profil Saya
															</span>
												
														</span>
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="profilesiswa" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-edit"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">
																Edit Profil Saya
															</span>
													
														</span>
													</span>
												</a>
											</li>
											
										</ul>
										<div class="m-portlet__body-separator"></div>
									
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
								
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="profilesiswa/update/{{ Auth::user()->idtbSiswa}}">
													{{ csrf_field() }}
    													{{ method_field('PUT') }}
												<div class="m-portlet__body">
													<div class="form-group m-form__group m--margin-top-10 m--hide">
														<div class="alert m-alert m-alert--default" role="alert">
															The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
														</div>
													</div>
													<div class="form-group m-form__group row">
														<div class="col-7 ml-auto">
															<h3 class="m-form__section">
																1. Profil Siswa
															</h3>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Nama Wali
														</label>
														<div class="col-7">
														<input class="form-control{{ $errors->has('namaWali') ? ' is-invalid' : '' }}" type="text" name="namaWali" value="{{$isCompleted->namaWali}}">
																@if ($errors->has('namaWali'))
                                            						<span class="invalid-feedback" role="alert">
                                        								<strong>{{ $errors->first('namaWali') }}</strong>
																	</span> 
																@endif
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Pendidikan Siswa
														</label>
														<div class="col-7">
															<select class="form-control m-input" name="pendidikanSiswa" id="pendidikanSiswa">
																	<option>
																		1
																	</option>
																	<option>
																		2
																	</option>
																	<option>
																		3
																	</option>
																	<option>
																		4
																	</option>
																	<option>
																		5
																	</option>
																</select>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Jenjang
														</label>
														<div class="col-7">
															<select class="form-control m-input" name="jenjang" id="jenjang">
																	<option>
																		1
																	</option>
																	<option>
																		2
																	</option>
																	<option>
																		3
																	</option>
																	<option>
																		4
																	</option>
																	<option>
																		5
																	</option>
																</select>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label" >
															Prodi Siswa
														</label>
														<div class="col-7">
															<input class="form-control{{ $errors->has('prodiSiswa') ? ' is-invalid' : '' }}" type="text" name="prodiSiswa" value="{{ $isCompleted->prodiSiswa }}"">
															@if ($errors->has('prodiSiswa'))
                                            						<span class="invalid-feedback" role="alert">
                                        								<strong>{{ $errors->first('prodiSiswa') }}</strong>
																	</span> 
																@endif
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															No Telepon
														</label>
														<div class="col-7">
															<input class="form-control{{ $errors->has('NoTlpn') ? ' is-invalid' : '' }}" type="text" name="NoTlpn" value="{{ Auth::user()->NoTlpn }}">
																@if ($errors->has('NoTlpn'))
                                            						<span class="invalid-feedback" role="alert">
                                       									 <strong>{{ $errors->first('NoTlpn') }}</strong>
																	</span>
																@endif
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Email
														</label>
														<div class="col-7">
															<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" value="{{ Auth::user()->email }}">
																@if ($errors->has('email'))
                                            						<span class="invalid-feedback" role="alert">
                                        								<strong>{{ $errors->first('email') }}</strong>
																	</span> 
																@endif
														</div>
													</div>
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-7 ml-auto">
															<h3 class="m-form__section">
																2. Alamat Siswa
															</h3>
														</div>
													</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Provinsi
													</label>
													<div class="col-7">
														<select class="form-control m-input" id="exampleSelect1">
																<option>
																	1
																</option>
																<option>
																	2
																</option>
																<option>
																	3
																</option>
																<option>
																	4
																</option>
																<option>
																	5
																</option>
															</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Kabupaten
													</label>
													<div class="col-7">
														<select class="form-control m-input" id="exampleSelect1">
																<option>
																	1
																</option>
																<option>
																	2
																</option>
																<option>
																	3
																</option>
																<option>
																	4
																</option>
																<option>
																	5
																</option>
															</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Kecamatan
													</label>
													<div class="col-7">
														<select class="form-control m-input" id="exampleSelect1">
																<option>
																	1
																</option>
																<option>
																	2
																</option>
																<option>
																	3
																</option>
																<option>
																	4
																</option>
																<option>
																	5
																</option>
															</select>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-2 col-form-label">
														Kelurahan
													</label>
													<div class="col-7">
														<select class="form-control m-input" id="exampleSelect1">
																<option>
																	1
																</option>
																<option>
																	2
																</option>
																<option>
																	3
																</option>
																<option>
																	4
																</option>
																<option>
																	5
																</option>
															</select>
													</div>
												</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Alamat
														</label>
														<div class="col-7">
															<input class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" type="text" value="{{ Auth::user()->alamat }}">
															@if ($errors->has('alamat'))
                                            						<span class="invalid-feedback" role="alert">
                                        								<strong>{{ $errors->first('alamat') }}</strong>
																	</span> 
																@endif
														</div>
													</div>
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2"></div>
															<div class="col-7">
																<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
																	Save changes
																</button>
																<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																	Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="tab-pane active" id="m_user_profile_tab_2"></div>
										<div class="tab-pane active" id="m_user_profile_tab_3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end:: Body -->
	@endsection