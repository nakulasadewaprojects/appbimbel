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
										Export Excel
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">

							</div>
						</div>
						<div class="m-portlet__body">
							<div class="m-widget6">
								<div class="col-lg-4 col-md-9 col-sm-12">
									<form class="m-form m-form--label-align-right" method="GET" action="http://localhost/appbimbel/public/siswa/export_excel">
										<input class="form-control m-input" type="text" name="daterange" value="" />
										<select class="form-control m-input" name="siswa" type="text" id="pendidikanTerakhir">
											<option value="0">Semua Siswa</option>
											@foreach ($getdetailsiswa as $a)
											<option value="{{ $a->NoIDSiswa }}">{{$a->NamaLengkap}}</option>
											@endforeach
										</select>
										<select class="form-control m-input" name="matpel" type="text" id="pendidikanTerakhir">
											<option value="0">Semua Mata Pelajaran</option>
											@foreach ($getuniquematpel as $a)
											<option value="{{ $a }}">{{$a}}</option>
											@endforeach
										</select>
										<button type="submit" class="btn btn-primary">
											Export to Excel
										</button>
									</form>
								</div>
								{{-- <div class="m-widget6__foot">
													<div class="m-widget6__action m--align-right">
														<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">
															Export
														</button>
													</div>
												</div> --}}
							</div>
						</div>
						</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
@endsection