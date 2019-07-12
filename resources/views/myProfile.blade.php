@extends('layouts.mentor')
@section('content')
		<div class="m-content">
			<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="m-portlet">
							<div class="m-portlet__body">
									<div class="white-box">
											<div class="user-bg"> <img width="100%" alt="user" src="http://localhost/appbimbel/public/assets/img/large/img1.jpg">
												<div class="overlay-box">
													<div class="user-content">
														<a href="javascript:void(0)"><img src="http://localhost/appbimbel/public/assets/img/user/genu.jpg" class="thumb-lg img-circle" alt="img"></a>
														<h4 class="text-white">User Name</h4>
														<h5 class="text-white">info@myadmin.com</h5> </div>
												</div>
											</div>
											<div class="user-btm-box">
												<div class="col-md-4 col-sm-4 text-center">
													<p class="text-purple"><i class="ti-facebook"></i></p>
													<h1>258</h1> </div>
												<div class="col-md-4 col-sm-4 text-center">
													<p class="text-blue"><i class="ti-twitter"></i></p>
													<h1>125</h1> </div>
												<div class="col-md-4 col-sm-4 text-center">
													<p class="text-danger"><i class="ti-dribbble"></i></p>
													<h1>556</h1> </div>
											</div>
										</div>
							</div>
						</div>
					</div>

					<div class="col-xl-9 col-lg-8">
							<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
								<div class="tab-content">
									<div class="tab-pane active">
										{{-- <div class="m-portlet m-portlet--success m-portlet--head-solid-bg"> --}}
											<div class="m-portlet__head">
												<div class="m-portlet__head-caption">
													<div class="m-portlet__head-title">
														<h3 class="m-portlet__head-text">
															Profil Saya
														</h3>
													</div>
												</div>
											</div>

											<div class="white-box">
													<ul class="nav customtab nav-tabs" role="tablist">
														<li role="presentation" class="nav-item"><a href="#home" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Activity</span></a></li>
														<li role="presentation" class="nav-item"><a href="#profile" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
														<li role="presentation" class="nav-item"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Message</span></a></li>
														<li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Setting</span></a></li>
													</ul>
													<div class="tab-content">
														<div class="tab-pane active" id="home">
															<div class="steamline">
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/genu.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<p>assign a new task <a href="#"> Design weblayout</a></p>
																			<div class="m-t-20 row"><img src="../plugins/images/img1.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="../plugins/images/img2.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="../plugins/images/img3.jpg" alt="user" class="col-md-3 col-xs-12" /></div>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/sonu.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"> <a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<div class="m-t-20 row">
																				<div class="col-md-2 col-xs-12"><img src="../plugins/images/img1.jpg" alt="user" class="img-responsive" /></div>
																				<div class="col-md-9 col-xs-12">
																					<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa</p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
																			</div>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/govinda.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<p>assign a new task <a href="#"> Design weblayout</a></p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="profile">
															<div class="row">
																<div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
																	<br>
																	<p class="text-muted">Johnathan Deo</p>
																</div>
																<div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
																	<br>
																	<p class="text-muted">(123) 456 7890</p>
																</div>
																<div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
																	<br>
																	<p class="text-muted">johnathan@admin.com</p>
																</div>
																<div class="col-md-3 col-xs-6"> <strong>Location</strong>
																	<br>
																	<p class="text-muted">London</p>
																</div>
															</div>
															<hr>
															<p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
															<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
															<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
															<h4 class="font-bold m-t-30">Skill Set</h4>
															<hr>
															<h5>Wordpress <span class="pull-right">80%</span></h5>
															<div class="progress">
																<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
															</div>
															<h5>HTML 5 <span class="pull-right">90%</span></h5>
															<div class="progress">
																<div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
															</div>
															<h5>jQuery <span class="pull-right">50%</span></h5>
															<div class="progress">
																<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
															</div>
															<h5>Photoshop <span class="pull-right">70%</span></h5>
															<div class="progress">
																<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
															</div>
														</div>
														<div class="tab-pane" id="messages">
															<div class="steamline">
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/genu.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"> <a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<div class="m-t-20 row">
																				<div class="col-md-2 col-xs-12"><img src="../plugins/images/img1.jpg" alt="user" class="img-responsive" /></div>
																				<div class="col-md-9 col-xs-12">
																					<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa</p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
																			</div>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/sonu.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<p>assign a new task <a href="#"> Design weblayout</a></p>
																			<div class="m-t-20 row"><img src="../plugins/images/img1.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="../plugins/images/img2.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="../plugins/images/img3.jpg" alt="user" class="col-md-3 col-xs-12" /></div>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="sl-item">
																	<div class="sl-left"> <img src="../plugins/images/users/govinda.jpg" alt="user" class="img-circle" /> </div>
																	<div class="sl-right">
																		<div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
																			<p>assign a new task <a href="#"> Design weblayout</a></p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="settings">
															<form class="form-horizontal form-material">
																<div class="form-group">
																	<label class="col-md-12">Full Name</label>
																	<div class="col-md-12">
																		<input type="text" placeholder="Johnathan Doe" class="form-control form-control-line"> </div>
																</div>
																<div class="form-group">
																	<label for="example-email" class="col-md-12">Email</label>
																	<div class="col-md-12">
																		<input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email"> </div>
																</div>
																<div class="form-group">
																	<label class="col-md-12">Password</label>
																	<div class="col-md-12">
																		<input type="password" value="password" class="form-control form-control-line"> </div>
																</div>
																<div class="form-group">
																	<label class="col-md-12">Phone No</label>
																	<div class="col-md-12">
																		<input type="text" placeholder="123 456 7890" class="form-control form-control-line"> </div>
																</div>
																<div class="form-group">
																	<label class="col-md-12">Message</label>
																	<div class="col-md-12">
																		<textarea rows="5" class="form-control form-control-line"></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12">Select Country</label>
																	<div class="col-sm-12">
																		<select class="form-control form-control-line">
																			<option>London</option>
																			<option>India</option>
																			<option>Usa</option>
																			<option>Canada</option>
																			<option>Thailand</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-12">
																		<button class="btn btn-success">Update Profile</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
										{{-- </div> --}}
									</div>
								</div>
							</div>
					</div>	
				</div>
			</div>
		</div>
{{-- <div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	@if (DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('statKomplit')!==7)
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

	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="row">
			<div class="col-xl-3 col-lg-4">
				<div class="m-portlet">
					<div class="m-portlet__body">
						<div class="m-card-profile">
							<div class="m-card-profile__title m--hide">
								Your Profile
							</div>
							<div class="m-card-profile__pic">
								<div class="m-card-profile__pic-wrapper">
									@if(DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('foto')==NULL)
									<img src="{{ url('/data_fileSiswa/default_photo_profile.png') }}" height="100px" width="100px" alt="Anda Belum Upload Foto" />
									@else
									<a href="{{ url('/data_file/'.$isCompleted->foto) }}" class="thumbnail"> <img src="{{ url('/data_file2/'.$isCompleted->foto) }}" alt="Tidak Ada Foto" /></a>
									@endif
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
						<div class="tab-pane active">
							<div class="m-portlet m-portlet--success m-portlet--head-solid-bg">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<h3 class="m-portlet__head-text">
												Profil Saya
											</h3>
										</div>
									</div>
								</div>
								<div class="m-portlet__body">
									<div class="m-widget13">
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Username :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ Auth::user()->username }}
											</span>
										</div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Alamat Email :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ Auth::user()->email }}
											</span>
										</div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Nama Depan :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ Auth::user()->nm_depan }}
											</span>
										</div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Nama Belakang :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ Auth::user()->nm_belakang }}
											</span>
										</div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Jenis Kelamin :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												@if($m->gender!=2)
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
												{{ Auth::user()->alamat }} ,
												{{DB::table('kelurahan')->where('id', Auth::user()->kelurahan)->value('nama')}} ,
												{{DB::table('kecamatan')->where('id', Auth::user()->kecamatan)->value('nama')}} ,
												{{DB::table('kota_kabupaten')->where('id', Auth::user()->kota)->value('nama')}} ,
												{{DB::table('provinsi')->where('id', Auth::user()->provinsi)->value('nama')}}
											</span>


										</div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Nomor Telepon :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ Auth::user()->noTlpn }}
											</span>
										</div>
										<div class="m-form__seperator m-form__seperator--dashed"></div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Status Pendidikan :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												@if($isCompleted->statusPendidikan!=2)
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

												@if($isCompleted->pendidikanTerakhir==1)
												SD
												@elseif($isCompleted->pendidikanTerakhir==2)
												SMP
												@elseif($isCompleted->pendidikanTerakhir==3)
												SMA
												@elseif($isCompleted->pendidikanTerakhir==4)
												SMK
												@elseif($isCompleted->pendidikanTerakhir==5)
												D III
												@elseif($isCompleted->pendidikanTerakhir==6)
												S1
												@elseif($isCompleted->pendidikanTerakhir==7)
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
												{{ $isCompleted->prodi }}
											</span>
										</div>
										<div class="m-form__seperator m-form__seperator--dashed"></div>
										<div class="m-widget13__item">
											<span class="m-widget13__desc m--align-right">
												Pengalaman Kerja/Mengajar :
											</span>
											<span class="m-widget13__text m-widget13__text-bolder">
												{{ $isCompleted->pengalaman }}
											</span>
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
</div> --}}
@endsection