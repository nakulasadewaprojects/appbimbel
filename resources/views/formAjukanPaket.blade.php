@extends('layouts.siswa') 
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

<div class="m-content">
<!--begin::Portlet-->
<div class="row">
	<div class="col-lg-10">
		<!--begin::Portlet-->
		<div class="m-portlet">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<span class="m-portlet__head-icon m--hide">
							<i class="la la-gear"></i>
						</span>
						<h3 class="m-portlet__head-text">
							Form Pengajuan Paket Bimbel
						</h3>
					</div>
				</div>
			</div>
			<!--begin::Form-->
			<form class="m-form m-form--label-align-right"  method="POST" action="http://localhost/appbimbel/public/formAjukanPaket/input">
					{{ csrf_field() }}
				<div class="m-portlet__body">
					<div class="m-form__section m-form__section--first">
						<div class="m-form__heading">
							<h3 class="m-form__heading-title">
								Data Mentor
							</h3>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Nama Lengkap:
							</label>
							<div class="col-lg-6">
									<div class="input-group m-input-group m-input-group--square">
											<span class="input-group-addon">
												<i class="la la-user"></i>
											</span>
											<input type="hidden" class="form-control m-input" name="noIDTutor" value="{{$showmentor->NoIDMentor}}">
											<input type="text" readonly class="form-control m-input" name="namaMentor" value="{{$showmentor->nm_depan}} {{$showmentor->nm_belakang}}">
										</div>
								{{-- <input type="text" class="form-control m-input" name="namaMentor" value="{{$showmentor->nm_depan}} {{$showmentor->nm_belakang}}"> --}}
								{{-- <span class="m-form__help">
									Please enter your full name
								</span> --}}
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Alamat:
							</label>
							
							<div class="col-lg-6">
									<div class="form-group m-form__group m--margin-top-10">
											<div class="alert m-alert m-alert--default" role="alert">
													{{  $showmentor->alamat }} ,  
													{{DB::table('kelurahan')->where('id', $showmentor->kelurahan)->value('nama')}} ,
													{{DB::table('kecamatan')->where('id', $showmentor->kecamatan)->value('nama')}} ,
													{{DB::table('kota_kabupaten')->where('id', $showmentor->kota)->value('nama')}} ,
													{{DB::table('provinsi')->where('id', $showmentor->provinsi)->value('nama')}}
											</div>
										</div>
									
								{{-- <input type="email" class="form-control m-input" placeholder="Enter email">
								<span class="m-form__help">
									We'll never share your email with anyone else
								</span> --}}
							</div>
						</div>
						<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">
									Prodi:
								</label>
								<div class="col-lg-6">
										<div class="m-input-icon m-input-icon--right">
												<input readonly type="text" class="form-control m-input" value="{{$paket->matpel}}">
												<span class="m-input-icon__icon m-input-icon__icon--right">
													<span>
														<i class="la la-bookmark-o"></i>
													</span>
												</span>
											</div>
											<span class="m-form__help">
													Prodi paket mentor yang akan ajarkan 
											</span>
								</div>
						</div>
					</div>
					<div class="m-form__seperator m-form__seperator--dashed"></div>
					<div class="m-form__section m-form__section--middle">
						<div class="m-form__heading">
							<h3 class="m-form__heading-title">
								Data Siswa:
							</h3>
						</div>
						<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">
									Nama Lengkap:
								</label>
								<div class="col-lg-6">
										<div class="input-group m-input-group m-input-group--square">
												<span class="input-group-addon">
													<i class="la la-user"></i>
												</span>
												<input type="text" readonly class="form-control m-input" name="namaSiswa" value="{{$showsiswa->NamaLengkap}}">
											</div>
									{{-- <input type="text" class="form-control m-input" name="namaMentor" value="{{$showmentor->nm_depan}} {{$showmentor->nm_belakang}}"> --}}
									{{-- <span class="m-form__help">
										Please enter your full name
									</span> --}}
								</div>
							</div>
							<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Alamat:
							</label>
							<div class="col-lg-6">
									<div class="form-group m-form__group m--margin-top-10">
											<div class="alert m-alert m-alert--default" role="alert">
													{{  $showsiswa->alamat }} ,  
													{{DB::table('kelurahan')->where('id', $showsiswa->kelurahan)->value('nama')}} ,
													{{DB::table('kecamatan')->where('id', $showsiswa->kecamatan)->value('nama')}} ,
													{{DB::table('kota_kabupaten')->where('id', $showsiswa->kota)->value('nama')}} ,
													{{DB::table('provinsi')->where('id', $showsiswa->provinsi)->value('nama')}}
											</div>
										</div>
									
								{{-- <input type="email" class="form-control m-input" placeholder="Enter email">
								<span class="m-form__help">
									We'll never share your email with anyone else
								</span> --}}
							</div>
						</div>
						<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">
									No Telepon:
								</label>
								<div class="col-lg-6">
										<div class="input-group m-input-group m-input-group--square">
												<span class="input-group-addon">
													<i class="la la-info-circle"></i>
												</span>
												<input type="text" readonly class="form-control m-input"name="namaMentor" value="{{$showsiswa->NoTlpn}}">
											</div>
									{{-- <input type="text" class="form-control m-input" name="namaMentor" value="{{$showmentor->nm_depan}} {{$showmentor->nm_belakang}}"> --}}
									{{-- <span class="m-form__help">
										Please enter your full name
									</span> --}}
								</div>
							</div>
							

						
					</div>
					<div class="m-form__seperator m-form__seperator--dashed"></div>
					<div class="m-form__section m-form__section--last">
						<div class="m-form__heading">
							<h3 class="m-form__heading-title">
							Pengajuan :
							</h3>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Mulai Bimbel:
							</label>
								<div class="col-lg-6 col-md-9 col-sm-12">
									<div class='input-group date' id='m_datepicker_2'>
										<input type='text'  class="form-control m-input" required placeholder="Select date" name="TanggalMulai"/>
											<span class="input-group-addon">
												<i class="la la-calendar-check-o"></i>
											</span>
									</div>
									<span class="m-form__help">
										Harap pilih tanggal sesuai hari bimbel yang diinginkan
								</span>
								</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Durasi Bimbel:
							</label>
							<div class="col-lg-6 col-md-9 col-sm-12">
									{{-- <select class="form-control m-bootstrap-select m_selectpicker" required title="Pilih Durasi Bimbel" name="durasi">
										<optgroup label=" Bulan">
											<option value="1" > 1 bulan </option>
										</optgroup>
										<optgroup label="Semester">
											<option value="6" > 1 Semester </option>
											<option value="12" > 2 Semester </option>																																											
										</optgroup>
									</select> --}}
									<input readonly type="text" class="form-control m-input" value="{{$paket->durasi}} bulan">
								</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Hari Bimbel:
							</label>
								<div class="col-lg-6 col-md-9 col-sm-12">
									{{-- <select class="form-control m-bootstrap-select m_selectpicker" required name="hari[]" multiple>
										<option value="Senin" > Senin</option>
										<option value="Selasa" > Selasa</option>																																											
										<option value="Rabu" > Rabu </option>																																											
										<option value="Kamis" > Kamis</option>																																											
										<option value="Jumat" > Jumat</option>																																											
										<option value="Sabtu" > Sabtu</option>																																											
										<option value="Minggu" > Minggu</option>																																											
									</select> --}}
									<input readonly type="text" class="form-control m-input" value="{{$paket->hari}}">											
								</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
										Waktu Bimbel :
							</label>
								<div class="col-lg-6 col-md-9 col-sm-12">
									<div class='input-group timepicker'  >
											{{-- <input type='text' class="form-control" id="m_timepicker_1" required name="waktuMulai" placeholder="Select time" type="text"/> --}}
										<input readonly type="text" class="form-control m-input" value="{{$paket->wkt_mulai}}">											
										<span class="input-group-addon">
											<i class="la la-clock-o"></i>
										</span>
									</div>
									<span class="m-form__help">
											Lama Bimbel 45 menit, Istirahat 15 menit
									</span>
								</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
									Akhir Bimbel :
								</label>
							<div class="col-lg-6 col-md-9 col-sm-12">
								<div class='input-group timepicker' >
									{{-- <input type='text' class="form-control" id="m_timepicker_1" required name="waktuSelesai" placeholder="Select time" type="text"/> --}}
									<input readonly type="text" class="form-control m-input" value="{{$paket->wkt_akhir}}">																				
									<span class="input-group-addon">
										<i class="la la-clock-o"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">
									Prodi:
								</label>
								<div class="col-lg-6 col-md-9 col-sm-12">
										{{-- <select class="form-control m-bootstrap-select m_selectpicker" required name="prodi[]" multiple>
												@foreach ($prodiPaket as $mp)
												<option value="{{ $mp }}" > {{ $mp }}</option>
												@endforeach	
										</select> --}}
									<input readonly type="text" class="form-control m-input" value="{{$paket->matpel}}">																				
										<span class="m-form__help">
											Prodi bimbel sesuai dengan paket yang ditentukan oleh mentor 
										</span>
									</div>
										{{-- <span class="m-form__help">
												Prodi siswa yang dipilih
											</span> --}}
						</div>
					</div>
					
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions">
						<div class="row">
							<div class="col-lg-2"></div>
							<div class="col-lg-6">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
								<button type="reset" class="btn btn-secondary">
									Cancel
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->

	</div>
</div>
</div>
</div>
</div>



<!--end::Portlet-->

@endsection