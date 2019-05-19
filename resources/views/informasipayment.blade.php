@extends('layouts.siswa')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
                <div class="col-xl-12">
                                <div class="col-xl-11">
									<!--begin:: Widgets/Finance Stats-->
									<div class="m-portlet  m-portlet--full-height ">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text">
														Informasi Payment
													</h3>
												</div>
											</div>
											<div class="m-portlet__head-tools">											
											</div>
										</div>
										<div class="m-portlet__body">
											<div class="m-widget1 m-widget1--paddingless">
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">
																IPO Margin
															</h3>
															<span class="m-widget1__desc">
																Awerage IPO Margin
															</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-accent">
																+24%
															</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">
																Payments
															</h3>
															<span class="m-widget1__desc">
																Yearly Expenses
															</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-info">
																+$560,800
															</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">
																Logistics
															</h3>
															<span class="m-widget1__desc">
																Overall Regional Logistics
															</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-warning">
																-10%
															</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">
																Expenses
															</h3>
															<span class="m-widget1__desc">
																Balance
															</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-danger">
																$345,000
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end:: Widgets/Finance Stats-->
                                </div>
                </div>   
        </div>
    </div> 
</div>   
                               
@endsection