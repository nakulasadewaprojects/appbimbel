@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                    <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
							<!--begin::Portlet-->
                            <div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Form Input Paket Bimbel
												</h3>
											</div>
										</div>
									</div>
									<!--begin::Form-->
                                    <form class="m-form m-form--label-align-right"  method="POST" action="http://localhost/appbimbel/public/paketbimbel/input">
                                        {{ csrf_field() }}
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
                                                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-brand alert-dismissible fade show" role="alert">
                                                            <div class="m-alert__icon">
                                                                <i class="flaticon-exclamation-1"></i>
                                                                <span></span>
                                                            </div>
                                                            <div class="m-alert__text">
                                                                <strong>
                                                                    MAKSIMAL
                                                                </strong>
                                                                 anda dapat membuat 4 paket!
                                                            </div>
                                                            <div class="m-alert__close">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>
												<div class="form-group m-form__group row">
													<label class="col-lg-2 col-form-label">
														Nama Paket:
													</label>
													<div class="col-lg-6">
                                                    <input type="hidden"required name="id" class="form-control m-input" value="{{$m->NoIDMentor}}" >
														<input type="text"required name="nama" class="form-control m-input" >
														{{-- <span class="m-form__help">
															Please enter your paket name
														</span> --}}
													</div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">
                                                        Harga:
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="number" required name="harga" class="form-control m-input" >
                                                        <span class="m-form__help">
                                                            Tentukan harga paket Anda
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">
                                                        Durasi:
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="number" name="durasi" required class="form-control m-input"> 
                                                        <span class="m-form__help">
                                                            Durasi Bimbel dalam hitungan bulan 
                                                        </span>
                                                    </div>
                                                </div>												
                                                <div class="form-group m-form__group row">
                                                        <label class="col-lg-2 col-form-label">
                                                            Hari:
                                                        </label>
                                                        <div class="col-lg-6">
                                                            {{-- <input type="email" name="hari" class="form-control m-input"> --}}
                                                            <select class="form-control m-bootstrap-select m_selectpicker" name="hari[]" multiple>
                                                                <option value="Senin" > Senin</option>
                                                                <option value="Selasa" > Selasa</option>																																											
                                                                <option value="Rabu" > Rabu </option>																																											
                                                                <option value="Kamis" > Kamis</option>																																											
                                                                <option value="Jumat" > Jumat</option>																																											
                                                                <option value="Sabtu" > Sabtu</option>																																											
                                                                <option value="Minggu" > Minggu</option>																																											
                                                            </select>
                                                            <span class="m-form__help">
                                                                Tentukan Hari atau Siswa yang memilih hari bimbel
                                                            </span>
                                                        </div>
                                                        <span class="m-form__help">
                                                               *Boleh kosong
                                                            </span>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">
                                                        Waktu Mulai:
                                                    </label>
                                                    <div class="col-lg-6">
                                                        {{-- <input type="email" class="form-control m-input"> --}}
											            <input type="text" class="form-control" name="waktuMulai" id="m_timepicker_2" placeholder="Select time" />
                                                        <span class="m-form__help">
                                                            Tentukan waktu atau Siswa yang memilih waktu bimbel 
                                                        </span>
                                                    </div>
                                                    {{-- <div class="form-control-feedback">
												Sorry, that username's taken. Try another?
											</div> --}}
                                                    <span class="m-form__help" >
                                                        *Boleh kosong
                                                     </span>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">
                                                        Waktu Akhir:
                                                    </label>
                                                    <div class="col-lg-6">
											            <input type='text' class="form-control" id="m_timepicker_2" name="waktuAkhir" placeholder="Select time" />
                                                        {{-- <input type="email" class="form-control m-input"> --}}
                                                        {{-- <span class="m-form__help">
                                                            We'll never share your email with anyone else
                                                        </span> --}}
                                                    </div>
                                                </div>                                          
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">
                                                        Mata Pelajaran:
                                                    </label>
                                                    <div class="col-lg-6">
                                                        {{-- <input type="email" class="form-control m-input" > --}}
                                                        <select class="form-control m-bootstrap-select m_selectpicker" required name="matpel[]" multiple>
                                                                <option value="Bhs.Indonesia" > Bahasa Indonesia</option>
                                                                <option value="Matematika" > Matematika</option>																																											
                                                                <option value="IPA" > IPA </option>																																											
                                                                <option value="IPS" > IPS</option>																																											
                                                                <option value="Bhs.Inggris" >Bahasa Inggris</option>																																																																																						
                                                        </select>
                                                        <span class="m-form__help">
                                                            Pilih Mata Pelajaran yang ingin anda ajarkan
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-lg-2 col-form-label">
                                                        Keterangan:
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="keterangan" class="form-control m-input" required >
                                                        <span class="m-form__help">
                                                            Tambahkan Keterangan yang anda inginkan
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group m-form__group row">
                                                        <label class="col-lg-2 col-form-label">
                                                            Status Paket:
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <select class="form-control m-bootstrap-select m_selectpicker" name="statusPaket">
                                                                <option value="1" > Aktif</option>
                                                                <option value="2" > Non Aktif</option>																																																																																						
                                                            </select>
                                                            <span class="m-form__help">
                                                                We'll never share your email with anyone else
                                                            </span>
                                                        </div>
                                                </div>                                                                                                       										 --}}
											</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-2"></div>
													<div class="col-lg-6">
														<button type="submit" class="btn btn-primary">
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
								<!--end::Portlet-->
							<!--end::Portlet-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection