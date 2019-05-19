@extends('layouts.siswa')
@section('content')


<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">

		<!--Begin::Main Portlet-->
		<div class="row">
			@foreach($apvBimb as $apv )

			<div class="col-xl-6">
				<!--begin:: Widgets/Finance Summary-->
				<div class="m-portlet m-portlet--full-height ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Finance Summary
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-danger">
										Today
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 34.5px;"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__section m-nav__section--first">
															<span class="m-nav__section-text">
																Quick Actions
															</span>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Activity
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-chat-1"></i>
																<span class="m-nav__link-text">
																	Messages
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-info"></i>
																<span class="m-nav__link-text">
																	FAQ
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																<span class="m-nav__link-text">
																	Support
																</span>
															</a>
														</li>
														<li class="m-nav__separator m-nav__separator--fit"></li>
														<li class="m-nav__item">
															<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-widget12">
							<div class="m-widget12__item">
								<span class="m-widget12__text1">
									Nama Mentor
									<br>
									<span>
										{{$apv->nm_depan}} {{$apv->nm_belakang}}
									</span>
								</span>
								<span class="m-widget12__text2">
									Mata Pelajaran
									<br>
									<span>
										{{$apv->prodi}}
									</span>
								</span>
							</div>
							<div class="m-widget12__item">
								<span class="m-widget12__text1">
									Mulai Bimbel
									<br>
									<span>
										{{$apv->startBimbel}}
									</span>
								</span>
								<span class="m-widget12__text2">
									Akhir Bimbel
									<br>
									<span>
										{{$apv->endBimbel}}
									</span>
								</span>
							</div>
							<div class="m-widget12__item">
								<span class="m-widget12__text1">
									Durasi
									<br>
									<span>
										{{$apv->durasi}}
									</span>
								</span>
								<span class="m-widget12__text2">
									Status
									<br>
									<span>
										@if($apv->statusBimbel==1)
										pending
										@elseif($apv->statusBimbel==2)
										approval
										@else
										Cancel
										@endif
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<!--end:: Widgets/Finance Summary-->
			</div>
			@endforeach

		</div>
	</div>
</div>
</div>
<!--End::Main Portlet-->
@endsection