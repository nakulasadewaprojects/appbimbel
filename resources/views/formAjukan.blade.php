@extends('layouts.siswa')
@section('content')


<div class="m-content">
	<div class="row">
		<div class="col-xl-12">
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
								<input type="text" class="form-control m-input" value="{{$showsiswa->NamaLengkap}}">
							</div>
							<label class="col-lg-1 col-form-label">
								Alamat:
							</label>
							<div class="col-lg-3">
								<div class="m-input-icon m-input-icon--right">
									<!-- <input type="text" class="form-control m-input" value="{{$showsiswa->alamat}}"> -->

									{{ $showsiswa->alamat }} ,
									{{DB::table('kelurahan')->where('id', $showsiswa->kelurahan)->value('nama')}} ,
									{{DB::table('kecamatan')->where('id', $showsiswa->kecamatan)->value('nama')}} ,
									{{DB::table('kota_kabupaten')->where('id', $showsiswa->kota)->value('nama')}} ,
									{{DB::table('provinsi')->where('id', $showsiswa->provinsi)->value('nama')}}

								</div>
							</div>
							<label class="col-lg-1 col-form-label">
								Nomor Telepon:
							</label>
							<div class="col-lg-3">
								<input type="text" class="form-control m-input" value="{{$showsiswa->NoTlpn}}"">
												</div>
											</div>
											<div class=" form-group m-form__group row">
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
											@foreach ($explode as $s)
											<option value="{{ $s }}"> {{ $s }}</option>
											@endforeach
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
										<button type="submit" class="btn btn-brand">
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
		</div>
	</div>
</div>
</div>
<!--end::Portlet-->
@endsection