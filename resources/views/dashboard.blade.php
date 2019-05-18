@extends('layouts.mentor')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
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
	<div class="m-subheader-search">
		<h2 class="m-subheader-search__title">
			Cari Jadwal Mengajar
		</h2>
		<form class="m-form">
			<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
				<span class="m-input-icon__icon m-input-icon__icon--right">
				</span>
			</div>
			<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-md m-input-icon--right">
				<span class="m-input-icon__icon m-input-icon__icon--right">
				</span>
			</div>
			<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>

		</form>
	</div>
	<div class="m-content">
		<div class="m-portlet ">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-md-12 col-lg-6 col-xl-3">
						<!--begin::Total Profit-->
						<div class="m-widget24">
							<div class="m-widget24__item">
								<h4 class="m-widget24__title">
									Total Frofit
								</h4>
								<br>
								<span class="m-widget24__desc">
									All Customs Value
								</span>
								<span class="m-widget24__stats m--font-brand">
									$17,800
								</span>
								<div class="m--space-10"></div>
								<div class="progress m-progress--sm">
									<div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<span class="m-widget24__change">
									Change
								</span>
								<span class="m-widget24__number">
									78%
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		</div>
	</div>
</div>
</div>
@endsection