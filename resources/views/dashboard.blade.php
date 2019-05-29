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
			<a class="btn btn-info btn-sm m-btn m-btn--pill m-btn--wide" href="http://localhost/appbimbel/public/profile">Lengkapi Sekarang</a>
		</div>
	</div>
	@endif
	@if (strpos(DB::table('siswabimbel')->where('NoIDTutor', Auth::user()->NoIDMentor)->get('statusBimbel'), '1') !== false)
	<div class="m-alert m-alert--icon alert alert-info" role="alert">
		<div class="m-alert__icon">
			<i class="la la-info"></i>
		</div>
		<div class="m-alert__text">
			<strong>
				INFO!
			</strong>
			Ada siswa yang mengajukan bimbel, Silakan cek di menu pengajuan
		</div>
		<div class="m-alert__actions" style="width: 160px;">
			<a class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide" href="http://localhost/appbimbel/public/approvalmentor">Cek Sekarang</a>
		</div>
	</div>
	@endif

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/siswa.jpg" alt="First slide">
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/siswa.jpg" alt="Second slide">
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="http://localhost/appbimbel/public/assets/img/siswa.jpg" alt="Third slide">
		  </div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="m-content">
		<!--Begin::Main Portlet-->
		<div class="m-portlet">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-xl-4">
						<!--begin:: Widgets/Stats2-1 -->
						<div class="m-widget1">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Jumlah Siswa
										</h3>
										{{-- <span class="m-widget1__desc">
											Awerage Weekly Profit
										</span> --}}
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-brand">
											+$17,800
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Jumlah Pengajuan
										</h3>
										{{-- <span class="m-widget1__desc">
											Weekly Customer Orders
										</span> --}}
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-danger">
											+1,800
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Invoice
										</h3>
										{{-- <span class="m-widget1__desc">
											System bugs and issues
										</span> --}}
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-success">
											-27,49%
										</span>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Stats2-1 -->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Daily Sales-->
						<div class="m-widget14">
							<div class="m-widget14__header m--margin-bottom-30">
								<h3 class="m-widget14__title">
									Daily Report
								</h3>
								{{-- <span class="m-widget14__desc">
									Check out each collumn for more details
								</span> --}}
							</div>
							<div class="m-widget14__chart" style="height:120px;">
								<canvas  id="m_chart_daily_sales"></canvas>
							</div>
						</div>
						<!--end:: Widgets/Daily Sales-->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Profit Share-->
						<div class="m-widget14">
							<div class="m-widget14__header">
								<h3 class="m-widget14__title">
									Profit 
								</h3>
								{{-- <span class="m-widget14__desc">
									Profit Share between customers
								</span> --}}
							</div>
							<div class="row  align-items-center">
								<div class="col">
									<div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
										<div class="m-widget14__stat">
											45
										</div>
									</div>
								</div>
								<div class="col">
									<div class="m-widget14__legends">
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-accent"></span>
											<span class="m-widget14__legend-text">
												37% Sport Tickets
											</span>
										</div>
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-warning"></span>
											<span class="m-widget14__legend-text">
												47% Business Events
											</span>
										</div>
										<div class="m-widget14__legend">
											<span class="m-widget14__legend-bullet m--bg-brand"></span>
											<span class="m-widget14__legend-text">
												19% Others
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Profit Share-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Pengajuan
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            @foreach($jadwal as $jd)
                            <div class="m-widget3">
                                <div class="m-widget3__item">
                                    <div class="m-widget3__header">

                                        <div class="m-widget3__user-img">
                                            @if($jd->fotoProfile==NULL)
                                            <img class="m-widget3__img" src="{{ url('/data_fileSiswa/default_photo_profile.png') }}" />
                                            @else
                                            <img class="m-widget3__img" src="{{ url('/data_fileSiswa2/'.$jd->fotoProfile) }}" /></a>
                                            @endif
                                            {{-- <img class="m-widget3__img" src="" alt=""> --}}
                                        </div>
                                        <div class="m-widget3__info">
                                            <span class="m-widget3__username">
                                                {{$jd->NamaLengkap}}
                                                {{-- {{$jd-> NoIDBimbel}} --}}
                                                {{-- {{$jd->statusBimbel}} --}}
                                            </span>
                                            <br>
                                            <span class="m-widget3__time">
                                                {{$jd->prodiBimbel}}

                                            </span>
                                        </div>
                                        <span class="m-widget3__status m--font-info">
                                            @if($jd->statusSchedule==1)
                                            Pending
                                            @elseif($jd->statusSchedule==2)
                                            Approval
                                            @else
                                            Cancel
                                            @endif

                                        </span>
                                        {{-- <a href="detailApprovalBimbel/{{$jd->NoIDBimbel}}">
                                            <button type="button" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary" data-toggle="modal" data-target="#m_modal_3">
                                                Detail
                                            </button>
                                        </a> --}}
                                    </div>
                                    <div class="m-widget3__info">
                                        <p class="m-widget3__text">
                                            Mulai Bimbel {{$jd->tglprivate}}. Hari {{$jd->days}}. Waktu {{$jd->start}} - {{$jd->end}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
						</div>
						
					</div>
					
				</div>
				{{-- <div class="m-alert__actions" style="width: 160px;">
					<a class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide" href="http://localhost/appbimbel/public/approvalmentor">Cek Sekarang</a>
				</div> --}}
				<a href="http://localhost/appbimbel/public/approvalmentor">
					<button type="button" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary" data-toggle="modal" data-target="#m_modal_3">
						Cek Sekarang
					</button>
				</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection