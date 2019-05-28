@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
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
                                        Edit Paket Bimbel
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->

                        <form class="m-form m-form--label-align-right" method="POST" action="http://localhost/appbimbel/public/datapaket/updatepaket">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Nama Paket:
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="hidden" required name="id" class="form-control m-input" value="{{$paketbimbel->idpaket}}">
                                            <input type="text" required name="nama" class="form-control m-input" value="{{$paketbimbel->nmpaket}}">

                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Harga:
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" required name="harga" class="form-control m-input" value="{{$paketbimbel->harga}}">

                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Durasi:
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="durasi" required class="form-control m-input" value="{{$paketbimbel->durasi}}">
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
                                            <input type="text" name="hari" class="form-control m-input" value="{{$paketbimbel->hari}}" />
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Waktu Mulai:
                                        </label>
                                        <div class="col-lg-6">
                                            {{-- <input type="email" class="form-control m-input"> --}}
                                            <input type='text' name="waktumulai" class="form-control m-input" value="{{$paketbimbel->wkt_mulai}}" />

                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Waktu Akhir:
                                        </label>
                                        <div class="col-lg-6">
                                            {{-- <input type='text' class="form-control" id="m_timepicker_1" name="waktuAkhir" placeholder="Select time" value="{{$p->wkt_akhir}}" /> --}}
                                            <input type="text" name="waktuakhir" class="form-control m-input" value="{{$paketbimbel->wkt_akhir}}">

                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Mata Pelajaran:
                                        </label>
                                        <div class="col-lg-6">
                                            {{-- <input type="text" name="matpel"class="form-control m-input" value="{{$paketbimbel->matpel}}"> --}}

                                            <select required class="form-control m-select2" id="m_select2_3" name="matpel[]" multiple="multiple">
                                                @foreach($prodiMentor as $p)
                                                <option value="{{$p}}" @if(strpos($getprodi, $p )!==false) selected @endif> {{$p}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Keterangan:
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="keterangan" class="form-control m-input" required value="{{$paketbimbel->keterangan}}">

                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Status Paket:
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="statuspaket" class="form-control m-input" required value="{{$paketbimbel->statusPaket}}">

                                        </div>
                                    </div>
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