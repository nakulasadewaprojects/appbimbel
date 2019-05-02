@extends('layouts.mentor')
@section('content')
<!-- END: Left Aside -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Edit Profil Saya
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
								<!-- <a href="puppy.jpg"><img class="thumbnail" src="puppy_small.jpg" alt="Puppy" /></a> -->
								<a href="{{ url('/data_file/'.$isCompleted->foto) }}" class="thumbnail">	<img src="{{ url('/data_file2/'.$isCompleted->foto) }}"  alt="Tidak Ada Foto" /></a>
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
								<a href="myProfile" class="m-nav__link">
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
								<a href="profile" class="m-nav__link">
									<i class="m-nav__link-icon flaticon-edit"></i>
									<span class="m-nav__link-title">
										<span class="m-nav__link-wrap">
											<span class="m-nav__link-text">
												Edit Profil Saya
											</span>
											{{-- <span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span> --}}
										</span>
									</span>
								</a>
							</li>




						</ul>
						<div class="m-portlet__body-separator"></div>
						<div class="m-widget1 m-widget1--paddingless">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">


								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">


								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8">
				<div class="m-portlet m-portlet--full-height m-portlet--tabs">

					<div class="tab-content">
						<div class="tab-pane active" id="m_user_profile_tab_1">
							<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="profile/update/{{ Auth::user()->idmentor}}" enctype="multipart/form-data">
								<!-- <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="profile/update"> -->
								{{ csrf_field() }}
								<!-- {{ method_field('PUT') }} -->
								<div class="m-portlet__body">
									<div class="form-group m-form__group m--margin-top-10 m--hide">
										<div class="alert m-alert m-alert--default" role="alert">
											The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional
											classes.
										</div>
									</div>
									<div class="form-group m-form__group row">
										<div class="col-7 ml-auto">
											<h3 class="m-form__section">
												1. Personal Details
											</h3>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											username
										</label>
										<div class="col-7">
											<input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" type="text" value="{{ Auth::user()->username }}"> @if ($errors->has('username'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('username') }}</strong>
											</span> @endif
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											Nama Depan
										</label>
										<div class="col-7">
											<input class="form-control{{ $errors->has('NamaDepan') ? ' is-invalid' : '' }}" name="NamaDepan" type="text" value="{{ Auth::user()->nm_depan }}"> @if ($errors->has('NamaDepan'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('NamaDepan') }}</strong>
											</span> @endif
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											Nama Belakang
										</label>
										<div class="col-7">
											<input class="form-control{{ $errors->has('NamaBelakang') ? ' is-invalid' : '' }}" name="NamaBelakang" type="text" value="{{ Auth::user()->nm_belakang }}"> @if ($errors->has('NamaBelakang'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('NamaBelakang') }}</strong>
											</span> @endif
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											TTL
										</label>
										<div class="col-7">
											<input class="form-control m-input" type="text" value="Lumajang 17 April 1997">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label text-md-right">
											Jenis Kelamin
										</label>
										<div class="col-2">
											<label class="m-radio m-radio--bold m-radio--state-brand">
												<input type="radio" name="gender" id="male" value="1">
												Laki-Laki
												<span></span>
											</label>
											<label class="m-radio m-radio--bold m-radio--state-brand">
												<input type="radio" name="gender" id="female" value="2">
												Perempuan
												<span></span>
											</label>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											No Telepon
										</label>
										<div class="col-7">
											<input class="form-control{{ $errors->has('noTlpn') ? ' is-invalid' : '' }}" type="text" name="noTlpn" value="{{ Auth::user()->noTlpn }}"> @if ($errors->has('noTlpn'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('noTlpn') }}</strong>
											</span> @endif
										</div>
									</div>
									<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
									<div class="form-group m-form__group row">
										<div class="col-7 ml-auto">
											<h3 class="m-form__section">
												2. Address
											</h3>
										</div>
									</div>


									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											Provinsi
										</label>
										<div class="col-7">
											<select class="form-control m-input" name="provinsi" type="text">
																	<option value="">Pilih Provinsi</option>
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
												<option value=""> pilih kabupaten</option>
												@foreach ($b as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->kota ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
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
												<option value="">pilih kecamatan </option>
												@foreach ($c as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->kecamatan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
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
												<option value="">pilih kelurahan </option>
												@foreach ($d as $a)
												<option value="{{ $a->id }}" {{ Auth::user()->kelurahan ==  $a->id  ? 'selected' : ''}}>{{$a->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											Alamat
										</label>
										<div class="col-7">
											<input class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" type="text" value="{{ Auth::user()->alamat }}"> @if ($errors->has('alamat'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('alamat') }}</strong>
											</span> @endif
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">
											Kode Pos
										</label>
										<div class="col-7">
											<input class="form-control m-input" type="text" value="67371">
										</div>
									</div>
									<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
									<div class="form-group m-form__group row">
										<div class="col-7 ml-auto">
											<h3 class="m-form__section">
												3. Lengkapi Data
											</h3>
										</div>
									</div>								
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-3 col-form-label">
														Pendidikan Terakhir
													</label>
										<div class="col-7">
											<select class="form-control m-input" name="pendidikanTerakhir" type="text" id="pendidikanTerakhir">
															<option value=""> Pilih Pendidikan Terakhir </option>
										 					@foreach ($pt as $a)
															<option value="{{ $a->idMasterPendidikan }}"{{ $isCompleted->pendidikanTerakhir ==  $a->idMasterPendidikan  ? 'selected' : ''}}>{{$a->jenjangPendidikan}}</option>
															@endforeach
											</select>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-3 col-form-label text-md-right">
															Status Pendidikan
														</label>
										<div class="col-3">
											<label class="m-radio m-radio--bold m-radio--state-brand">
																<input type="radio" name="statusPendidikan" id="selesai" value="1">
																Selesai 
																<span></span>
														</label>
											<label class="m-radio m-radio--bold m-radio--state-brand">
																<input type="radio" name="statusPendidikan" id="masihpendidikan" value="2">
																Masih Pendidikan
																<span></span>
														</label>
										</div>
									</div>

									<div class="form-group m-form__group row">
										<label class="col-form-label col-lg-3 col-sm-12">
											Prodi Mentor
										</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
									<select class="form-control m-select2" id="m_select2_3" name="prodi[]" multiple="multiple">																							
													@foreach ($prodi as $a)
													<option value="{{ $a->MatPel }}"{{ $isCompleted->prodi ==  $a->MatPel  ? 'selected' : ''}}>{{$a->MatPel}}</option>
													@endforeach																																			
											</select>
										</div>
									</div>																					 
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-3 col-form-label">
															Foto
										</label>
										<div class="col-3">
											<label class="custom-file">
													<input type="file" name="foto">
													<!-- <span class="invalid-feedback" role="alert">
																<strong>{{ $errors->first('foto') }}</strong>
													</span> -->
												</label> 
											@if($isCompleted->foto!=null)
												<a href="{{ url('/data_file/'.$isCompleted->foto) }}" class="thumbnail"><img width="50px" height="50px" src="{{ url('/data_file2/'.$isCompleted->foto) }}"  alt=""></a>
											 @else
											Tidak Ada Foto 
											@endif
										</div>
									</div>
									<!-- @foreach($isCompleted as $ft) -->
									<!-- @endforeach -->
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-3 col-form-label">
											Nomor Identitas
										</label>
										<div class="col-7">
											<input class="form-control m-input" type="text" name="No_Identitas" value="{{ $isCompleted->No_Identitas }}">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-3 col-form-label">
											File KTP
										</label>
										<div class="col-3">
											<label class="custom-file">
												<input type="file" name="fileKTP">
													<!-- <span class="invalid-feedback" role="alert">
																<strong>{{ $errors->first('fileKTP') }}</strong>
													</span> -->
											</label>
											 @if($isCompleted->fileKTP!=null)
											 <a href="{{ url('/data_file/'.$isCompleted->fileKTP) }}" class="thumbnail"><img width="50px" height="50px" src="{{ url('/data_file2/'.$isCompleted->fileKTP) }}"></a> 
											@else Tidak Ada File @endif
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-3 col-form-label">
											File Ijazah
										</label>
										<div class="col-3">
											<label class="custom-file">
												<input type="file" name="fileIjazah">
												<!-- <span class="custom-file-control"></span> -->
											</label>
											<!-- <div class="col-md-2"> -->
											@if($isCompleted->fileIjazah!=null)
											<div class="m-demo-icon">
												<div class="m-demo-icon__preview">
													<i class="fa fa-file-pdf-o"></i>
												</div>
												<div class="m-demo-icon__class" id="myPDF">
												<a target="_blank" href="{{ url('/data_file/'.$isCompleted->fileIjazah) }}">{{ $isCompleted->fileIjazah }}"<a/>
												</div>
											</div>
											@else Tidak Ada File @endif
											<!-- </div> -->
											<!-- <embed width="100" height="150" src="{{ url('/data_file/'.$isCompleted->fileIjazah) }}"> -->
										</div>
									</div>
								</div>
								
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-3 col-form-label">
										Pengalaman
									</label>
									<div class="col-7">
										<input class="form-control m-input" type="text" name="pengalaman" value="{{ $isCompleted->pengalaman }}">																				
									</div>
								</div>
								<div class="m-portlet__foot m-portlet__foot--fit">
									<div class="m-form__actions">
										<div class="row">
											<div class="col-2"></div>
											<div class="col-7">
												<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
													Save changes
												</button> &nbsp;&nbsp;
												<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
													Cancel
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane active" id="m_user_profile_tab_2">

						</div>
						<div class="tab-pane active" id="m_user_profile_tab_3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection