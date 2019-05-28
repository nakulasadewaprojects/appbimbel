@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
			<div class="col-xl-12">
				<!--begin:: Widgets/Tasks -->		
					<div class="m-portlet">
						<div class="m-portlet__body m-portlet__body--no-padding">
							<div class="m-pricing-table-2">
								<div class="m-pricing-table-2__head">
									<div class="m-pricing-table-2__title m--font-light">
										<h2>
												Data Paket Bimbel
										</h2>
									</div>
									<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Maksimal anda dapat membuat 3 paket!
										</strong>										
									</div>
								</div>
								<div class="tab-content">
										<div class="tab-pane active" id="m-pricing-table_content1" aria-expanded="true">
											@if($getpaketcount==1)
											<div class="m-pricing-table-2__content">
												<div class="m-pricing-table-2__container">
													<div class="m-pricing-table-2__items row">
														@foreach($paket as $p)
														<div class="m-pricing-table-2__item col-lg-4">
															<div class="m-pricing-table-2__visual">
																<div class="m-pricing-table-2__hexagon"></div>
																<span class="m-pricing-table-2__icon m--font-info">
																	<i class="fa flaticon-confetti"></i>
																</span>
															</div>
															<h2 class="m-pricing-table-2__subtitle">
																	{{$p->nmpaket}}
															</h2>
															<div class="m-pricing-table-2__features">
																<span>
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
																<span>
																		{{$p->keterangan}}
																</span>
																
															</div>
															<span class="m-pricing-table-2__price">
																	Rp. {{$p->harga}}
															</span>										
															<div class="m-pricing-table-2__btn">
																<button type="button" class="btn m-btn--pill  btn-info m-btn--wide m-btn--uppercase m-btn--bolder m-btn--lg">
																	Purchase
																</button>
															</div>
														</div>
														@endforeach
													</div>
												</div>
											</div>
										</div>									
								</div>
								<div class="tab-content">
										<div class="tab-pane active" id="m-pricing-table_content1" aria-expanded="true">
											@elseif($getpaketcount==2)
											<div class="m-pricing-table-2__content">
												<div class="m-pricing-table-2__container">
													<div class="m-pricing-table-2__items row">
														@foreach($paket as $p)
														<div class="m-pricing-table-2__item col-lg-4">
															<div class="m-pricing-table-2__visual">
																<div class="m-pricing-table-2__hexagon"></div>
																<span class="m-pricing-table-2__icon m--font-info">
																	<i class="fa flaticon-confetti"></i>
																</span>
															</div>
															<h2 class="m-pricing-table-2__subtitle">
																	{{$p->nmpaket}}
															</h2>
															<div class="m-pricing-table-2__features">
																<span>
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
																<span>
																		{{$p->keterangan}}
																</span>
																
															</div>
															<span class="m-pricing-table-2__price">
																	Rp. {{$p->harga}}
															</span>										
															<div class="m-pricing-table-2__btn">
																<button type="button" class="btn m-btn--pill  btn-info m-btn--wide m-btn--uppercase m-btn--bolder m-btn--lg">
																	Purchase
																</button>
															</div>
														</div>
														@endforeach
													</div>
												</div>
											</div>
										</div>									
								</div>
								<div class="tab-content">
										<div class="tab-pane active" id="m-pricing-table_content1" aria-expanded="true">
											@elseif($getpaketcount==3)
											<div class="m-pricing-table-2__content">
												<div class="m-pricing-table-2__container">
													<div class="m-pricing-table-2__items row">
														@foreach($paket as $p)
														<div class="m-pricing-table-2__item col-lg-4">
															<div class="m-pricing-table-2__visual">
																<div class="m-pricing-table-2__hexagon"></div>
																<span class="m-pricing-table-2__icon m--font-info">
																	<i class="fa flaticon-confetti"></i>
																</span>
															</div>
															<h2 class="m-pricing-table-2__subtitle">
																	{{$p->nmpaket}}
															</h2>
															<div class="m-pricing-table-2__features">
																<span>
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
																<span>
																		{{$p->keterangan}}
																</span>
																
															</div>
															<span class="m-pricing-table-2__price">
																	Rp. {{$p->harga}}
															</span>										
															<div class="m-pricing-table-2__btn">
																<button type="button" class="btn m-btn--pill  btn-info m-btn--wide m-btn--uppercase m-btn--bolder m-btn--lg">
																	Purchase
																</button>
															</div>
														</div>
														@endforeach
													</div>
												</div>
											</div>
										</div>
										@endif									
								</div>

							</div>
						</div>
					</div>
					{{-- <div class="m-portlet__body">
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
					</div> --}}

				
				<!--end:: Widgets/Tasks -->
			</div>
		</div>
	</div>
</div>
</div>
@endsection