@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-md-10">
                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Form Input Laporan
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--label-align-right" method="POST" action="http://localhost/appbimbel/public/report/input">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Tanggal Bimbel:
                                        </label>
                                        <div class="col-lg-6 col-md-9 col-sm-12">
                                            <div class='input-group date' id='m_datepicker_3'>
                                            <input type="hidden" required name="idmentor" class="form-control m-input" value="{{$m->NoIDMentor}}"> 
                                                <input type='text' class="form-control m-input" required placeholder="Select date" name="tglBimbel" />
                                                <span class="input-group-addon">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Nama Siswa:
                                        </label>
                                        <div class="col-lg-6">

                                            <!-- <input type="hidden" required name="id" class="form-control m-input" value="{{$m->NoIDMentor}}"> -->
                                            <!-- <input type="hidden" required name="id" class="form-control m-input" value="{{$m->NoIDMentor}}"> -->
                                            {{-- <input type="text" required name="nama" class="form-control m-input"> --}}
                                            {{-- <span class="m-form__help">
															Please enter your paket name
                                                        </span> --}}
                                                        <select class="form-control m-bootstrap-select m_selectpicker" name="siswa">
                                                                <option value="">Pilih Siswa </option>                                                
                                                            @foreach ($siswaBimb as $sb)
                                                            <option value="{{ $sb->NoIDSiswa}}" > {{ $sb->NamaLengkap}}</option>
                                                            @endforeach	
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Waktu Mulai:
                                        </label>
                                        <div class="col-lg-6">
                                            {{-- <input type="email" class="form-control m-input"> --}}
                                            <input type='text' class="form-control" id="m_timepicker_2" name="waktuMulai" placeholder="Select time" />
                                            <span class="m-form__help">
                                                Waktu Bimbel selama 45 menit dan istirahat selama 15 menit
                                            </span>
                                        </div>
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
                                            <select class="form-control m-bootstrap-select m_selectpicker" name="prodi[]" multiple>
                                                    <option value="">Pilih Mata Pelajaran </option>                                                
                                                @foreach ($prodimentor as $mp)
                                                <option value="{{ $mp }}" > {{ $mp}}</option>
                                                @endforeach	
                                        </select>
                                            <span class="m-form__help">
                                                Pilih Mata Pelajaran
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Modul Mata Pelajaran:
                                        </label>
                                        <div class="col-lg-6">
                                                <select class="form-control m-bootstrap-select m_selectpicker" name="modul">
                                                        <option value="">Pilih Modul </option>                                                
                                                    @foreach ($modul as $mdl)
                                                    <option value="{{ $mdl->nama_modul }}" >
                                                        @if($mdl->matpel==1)
                                                            Bhs. Indonesia
                                                            @elseif($mdl->matpel==2)
                                                            Matematika
                                                            @elseif($mdl->matpel==3)
                                                            IPA
                                                            @elseif($mdl->matpel==4)
                                                            IPS
                                                            @else
                                                            Bhs. Iggris
                                                            @endif
                                                            
                                                            @if($mdl->jenjangpendidikan==1)
                                                            SD
                                                            @elseif($mdl->jenjangpendidikan==2)
                                                            SMP
                                                            @elseif($mdl->jenjangpendidikan==3)
                                                            SMA
                                                            @else
                                                            SMK
                                                            @endif
                                                        </option>
                                                    @endforeach	
                                            </select>
                                            <span class="m-form__help">
                                                Materi pembelajaran
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                            <label class="col-lg-2 col-form-label">
                                                Aktivitas:
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control m-input" type="text" rows="3" name="aktivitas"></textarea>
                                                <span class="m-form__help">
                                                    Tambahkan Aktivitas Bimbel
                                                </span>
                                            </div>
                                        </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Catatan:
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control m-input" type="text" rows="3" name="catatan"></textarea>
                                            <span class="m-form__help">
                                                Tambahkan Catatan untuk siswa
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-primary m-btn m-btn--custom">
                                                    Save
                                                </button>
                                                <button type="button" class="btn btn-danger m-btn m-btn--custom">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection