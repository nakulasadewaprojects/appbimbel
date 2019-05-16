@extends('layouts.siswa') 
@section('content')           
                                <!--begin::Portlet-->
                                <div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Form Approval Siswa
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
													Nama Siswa :
												</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input" value="{{$apvBimb->NamaLengkap}}">
												</div>
												<label class="col-lg-1 col-form-label">
													Alamat:
												</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input" value="{{$apvBimb->alamat}}">
												</div>
												<label class="col-lg-1 col-form-label">
													Nomor Telepon:
												</label>
												<div class="col-lg-3">
													<input type="text" class="form-control m-input"  value="{{$apvBimb->NoTlpn}}">
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-lg-1 col-form-label">
													Mulai Bimbel:
												</label>
												<div class="col-lg-3">
												<input class="form-control m-input" type="text" name="start" value="{{$apvBimb->startBimbel}}" id="example-datetime-local-input">
												</div>
												<label class="col-lg-1 col-form-label">
													Akhir Bimbel:
												</label>
												<div class="col-lg-3">
													<div class="m-input-icon m-input-icon--right">
												<input class="form-control m-input" type="text" name="end" value="{{$apvBimb->endBimbel}}" id="example-datetime-local-input">														
														<span class="m-input-icon__icon m-input-icon__icon--right">
														</span>
													</div>
												</div>
												<label class="col-lg-1 col-form-label">
													Mata Pelajaran:
												</label>
												<div class="col-lg-3">
												<input type="text" class="form-control m-input"  value="{{$apvBimb->prodi}}">													
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
                                <!--end::Portlet-->
 @endsection