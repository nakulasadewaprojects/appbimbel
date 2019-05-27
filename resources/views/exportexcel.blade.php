@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
                <div class="col-xl-12">
						<div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_1">
									<!--begin:: Widgets/Sales States-->
									<div class="m-portlet m-portlet--full-height ">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text">
														Sales Stats
													</h3>
												</div>
											</div>
											<div class="m-portlet__head-tools">

											</div>
										</div>
										<div class="m-portlet__body">
											<div class="m-widget6">
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="input-daterange input-group" id="m_datepicker_5">
														<input type="text" class="form-control m-input" name="start" />
														<span class="input-group-addon">
															<i class="la la-ellipsis-h"></i>
														</span>
														<input type="text" class="form-control" name="end" />
													</div>
													<a href="siswa/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
												</div>
												<div class="m-widget6__head">
													<div class="m-widget6__item">
														<span class="m-widget6__caption">
															Sceduled
														</span>
														<span class="m-widget6__caption">
															Count
														</span>
														<span class="m-widget6__caption m--align-right">
															Amount
														</span>
													</div>
												</div>
												<div class="m-widget6__body">
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															16/13/17
														</span>
														<span class="m-widget6__text">
															67
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$14,740
														</span>
													</div>
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															02/28/17
														</span>
														<span class="m-widget6__text">
															120
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$11,002
														</span>
													</div>
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															03/06/17
														</span>
														<span class="m-widget6__text">
															32
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$10,900
														</span>
													</div>
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															10/21/17
														</span>
														<span class="m-widget6__text">
															130
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$14,740
														</span>
													</div>
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															01/02/17
														</span>
														<span class="m-widget6__text">
															5
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$18,540
														</span>
													</div>
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															03/06/17
														</span>
														<span class="m-widget6__text">
															32
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$10,900
														</span>
													</div>
													<div class="m-widget6__item">
														<span class="m-widget6__text">
															12/31/17
														</span>
														<span class="m-widget6__text">
															201
														</span>
														<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
															$25,609
														</span>
													</div>
												</div>
												<div class="m-widget6__foot">
													<div class="m-widget6__action m--align-right">
														<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">
															Export
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end:: Widgets/Sales States-->
						</div>
				</div>
            </div>
        </div>
    </div>
</div>
 @endsection