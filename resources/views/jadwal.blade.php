@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
			<div class="col-xl-12">
				<div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_1">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Jadwal
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="tab-content">
							@foreach($jadwal as $jd)
							<div class="tab-pane active" id="m_widget2_tab1_content">
								<div class="m-widget2">
									<div class="m-widget2__item m-widget2__item--primary">
										<div class="m-widget2__checkbox">
										
										</div>
										<div class="m-widget2__desc">
											<span class="m-widget2__text">
												{{$jd->days}} pukul {{$jd->start}} sampai {{$jd->end}}
											</span>
											<br>
											<span class="m-widget2__user-name">
												<a href="#" class="m-widget2__link">
													{{$jd->NamaLengkap}}
												</a>
											</span>
											<br>
											<span class="m-widget2__user-name">
												<a href="#" class="m-widget2__link">
													{{$jd->prodiBimbel}}
												</a>
											</span>
											<br>
											<span class="m-widget2__user-name">
												<a href="#" class="m-widget2__link">
													{{$jd->alamat}}
													{{DB::table('kelurahan')->where('id', $jd->kelurahan)->value('nama')}}
													{{DB::table('kecamatan')->where('id', $jd->kecamatan)->value('nama')}}
													{{DB::table('kota_kabupaten')->where('id', $jd->kota)->value('nama')}}
													{{DB::table('provinsi')->where('id', $jd->provinsi)->value('nama')}}
												</a>
											</span>
										</div>
									</div>
							</div>	
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
@endsection