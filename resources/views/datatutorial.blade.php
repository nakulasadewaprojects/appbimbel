@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="row">
			<div class="col-xl-12">
				<div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_1">
						<div class="m-portlet m-portlet--mobile">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<h3 class="m-portlet__head-text">
												Data Tutorial
											</h3>
										</div>
									</div>
									<div class="m-portlet__head-tools">
										<ul class="m-portlet__nav">
											<li class="m-portlet__nav-item">										
											</li>
										</ul>
									</div>
								</div>
								<div class="m-portlet__body">
									<!--begin: Search Form -->
									<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
										<div class="row align-items-center">
											<div class="col-xl-8 order-2 order-xl-1">
												<div class="form-group m-form__group row align-items-center">
													<div class="col-md-4">
														<div class="m-input-icon m-input-icon--left">
															<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
															<span class="m-input-icon__icon m-input-icon__icon--left">
																<span>
																	<i class="la la-search"></i>
																</span>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-4 order-1 order-xl-2 m--align-right">
												<a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
													<span>
														<i class="la la-cart-plus"></i>
														<span>
															<b>New Order</b> 
														</span>
													</span>
												</a>
												<div class="m-separator m-separator--dashed d-xl-none"></div>
											</div>
										</div>
									</div>
									<!--end: Search Form -->
								<!--begin: Datatable -->
									<table class="m-datatable" id="html_table" width="100%">
										<thead>
											<tr>
												<th title="Field #1">
													Nama Modul
												</th>
												<th title="Field #4">
													File
												</th>
												<th title="Field #5">
													Jenjang Pendidikan
												</th>
												<th title="Field #5">
													Mata Pelajaran
												</th>
												<th title="Field #2">
														Tanggal Upload
													</th>
												<th title="Field #7">
													Action
												</th>
											</tr>
										</thead>
										<tbody>
										@foreach($tutorial as $t)
										<tr>											
											<td>
												{{$t->nama_modul}}
											</td>
											<td>
												<img src="assets/app/media/img/files/pdf.svg" height="30px" width="30px" alt="" id="myPDF">
                                                <a target="_blank" href="{{ url('/data_modul/'.$t->file) }}">{{$t->file}}</a>
											</td>
											<td>
												@if($t->jenjangpendidikan==1)
												SD
												@elseif($t->jenjangpendidikan==2)
												SMP
												@elseif($t->jenjangpendidikan==3)
												SMA
												@else
												SMK
												@endif
											</td>
											<td>
													@if($t->matpel==1)
													Bhs. Indonesia
													@elseif($t->matpel==2)
													Matematika
													@elseif($t->matpel==3)
													IPA
													@elseif($t->matpel==4)
													IPS
													@else
													Bhs. Iggris
													@endif
											</td>
											<td>{{$t->tgl_upload}}</td>
											
											<td>
												<a href="http://localhost/appbimbel/public/datatutorial/hapustutorial/{{$t->idmodul}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
														<i class="la la-folder"></i>
												</a>
												<a href="http://localhost/appbimbel/public/datatutorial/edittutorial/{{$t->idmodul}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only">
													<i class="la la-edit"></i>	
												</a>
																								
												{{-- <a href="http://localhost/appbimbel/public/datatutorial/edittutorial/{{$t->idmodul}}">Edit</a>
												<a href="http://localhost/appbimbel/public/datatutorial/hapustutorial/{{$t->idmodul}}">Hapus</a> --}}
											</td>																			
										</tr>
										@endforeach
										</tbody> 
										
									</table>
									<!--end: Datatable -->
								</div>
					</div>
			</div>
			</div>
		</div>
	</div>
</div>

</div>
@endsection