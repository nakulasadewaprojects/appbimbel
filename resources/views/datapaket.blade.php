@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
			<div class="col-xl-12">
				<!--begin:: Widgets/Tasks -->
				<div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon">
									<i class="la la-puzzle-piece"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Data Paket Bimbel
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-pricing-table-3 m-pricing-table-3--fixed">
							@if($getpaketcount==1)
							<div class="m-pricing-table-1">
								<div class="m-pricing-table-1__items row">
									@foreach($paket as $p)
									<div class="m-pricing-table-1__item col-lg-6">
										<div class="m-pricing-table-1__visual">
											<div class="m-pricing-table-1__hexagon1"></div>
											<div class="m-pricing-table-1__hexagon2"></div>
											<span class="m-pricing-table-1__icon m--font-brand">
												<i class="fa fa-dollar"></i>
											</span>
										</div>
										<span class="m-pricing-table-1__price">
											Rp. {{$p->harga}}
										</span>
										
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->nmpaket}}
										</h2>
										<span class="m-pricing-table-1__description">
											Bimbel selama {{$p->durasi}} bulan
											<br>
											@if($p->hari!=NULL)
											Hari {{$p->hari}}
											@else
											Hari Tentukan sendiri
											@endif
											<br>
											@if($p->wkt_mulai!=NULL)
											Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
											@else
											Jam Tentukan Sendiri
											@endif
										</span>
										
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->keterangan}}
										</h2>
										<div class="m-pricing-table-1__btn">
											<a href="http://localhost/appbimbel/public/datapaket/editpaket/{{$p->idpaket}}">
												<button type="button" class="btn btn-primary">
													Edit Paket
												</button>
												<button type="button" class="btn btn-danger">
													Non Aktif
												</button>
											</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@elseif($getpaketcount==2)
							<div class="m-pricing-table-1">
								<div class="m-pricing-table-1__items row">
									@foreach($paket as $p)
									<div class="m-pricing-table-1__item col-lg-6">
										<div class="m-pricing-table-1__visual">
											<div class="m-pricing-table-1__hexagon1"></div>
											<div class="m-pricing-table-1__hexagon2"></div>
											<span class="m-pricing-table-1__icon m--font-brand">
												<i class="fa fa-euro"></i>
											</span>
										</div>
										<span class="m-pricing-table-1__price">
											Rp. {{$p->harga}}
										</span>
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->nmpaket}}
										</h2>
										<span class="m-pricing-table-1__description">
											Bimbel selama {{$p->durasi}} bulan
											<br>
											@if($p->hari!=NULL)
											Hari {{$p->hari}}
											@else
											Hari Tentukan sendiri
											@endif
											<br>
											@if($p->wkt_mulai!=NULL)
											Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
											@else
											Jam Tentukan Sendiri
											@endif
										</span>
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->keterangan}}
										</h2>
										<div class="m-pricing-table-1__btn">
											<a href="http://localhost/appbimbel/public/datapaket/editpaket/{{$p->idpaket}}">
												<button type="button" class="btn btn-primary">
													Edit Paket
												</button>
												<button type="button" class="btn btn-danger">
													Non Aktif
												</button>
											</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@elseif($getpaketcount==3)
							<div class="m-pricing-table-1">
								<div class="m-pricing-table-1__items row">
									@foreach($paket as $p)
									<div class="m-pricing-table-1__item col-lg-4">
										<div class="m-pricing-table-1__visual">
											<div class="m-pricing-table-1__hexagon1"></div>
											<div class="m-pricing-table-1__hexagon2"></div>
											<span class="m-pricing-table-1__icon m--font-brand">
												<i class="fa fa-yen"></i>
											</span>
										</div>
										<span class="m-pricing-table-1__price">
											Rp. {{$p->harga}}
											
										</span>
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->nmpaket}}
										</h2>
										<span class="m-pricing-table-1__description">
											Bimbel selama {{$p->durasi}} bulan
											<br>
											@if($p->hari!=NULL)
											Hari {{$p->hari}}
											@else
											Hari Tentukan sendiri
											@endif
											<br>
											@if($p->wkt_mulai!=NULL)
											Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
											@else
											Jam Tentukan Sendiri
											@endif
										</span>
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->keterangan}}
										</h2>
										<div class="m-pricing-table-1__btn">
											<a href="http://localhost/appbimbel/public/datapaket/editpaket/{{$p->idpaket}}">
												<button type="button" class="btn btn-primary">
													Edit Paket
												</button>
												<button type="button" class="btn btn-danger">
													Non Aktif
												</button>
											</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@elseif($getpaketcount==4)
							<div class="m-pricing-table-1">
								<div class="m-pricing-table-1__items row">
									@foreach($paket as $p)
									<div class="m-pricing-table-1__item col-lg-3">
										<div class="m-pricing-table-1__visual">
											<div class="m-pricing-table-1__hexagon1"></div>
											<div class="m-pricing-table-1__hexagon2"></div>
											<span class="m-pricing-table-1__icon m--font-brand">
												<i class="fa fa-bitcoin"></i>
											</span>
										</div>
										<span class="m-pricing-table-1__price">
											Rp. {{$p->harga}}
											
										</span>
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->nmpaket}}
										</h2>
										<span class="m-pricing-table-1__description">
											Bimbel selama {{$p->durasi}} bulan
											<br>
											@if($p->hari!=NULL)
											Hari {{$p->hari}}
											@else
											Hari Tentukan sendiri
											@endif
											<br>
											@if($p->wkt_mulai!=NULL)
											Jam {{$p->wkt_mulai}} - {{$p->wkt_akhir}}
											@else
											Jam Tentukan Sendiri
											@endif
										</span>
										<h2 class="m-pricing-table-1__subtitle">
											{{$p->keterangan}}
										</h2>
										<div class="m-pricing-table-1__btn">
											<a href="http://localhost/appbimbel/public/datapaket/editpaket/{{$p->idpaket}}">
												<button type="button" class="btn btn-primary">
													Edit Paket
												</button>
												<button type="button" class="btn btn-danger">
													Non Aktif
												</button>
											</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@endif
						</div>
					</div>

				</div>
				<!--end:: Widgets/Tasks -->
			</div>
		</div>
	</div>

</div>

</div>
@endsection