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

	<div class="m-content">

		<div class="row">

			<div class="col-xl-12">
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
</div>
@endsection