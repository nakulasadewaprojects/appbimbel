@extends('layouts.siswa')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Review Mentor
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
                                            Nilai :
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control m-bootstrap-select m_selectpicker" required name="matpel[]" multiple>
                                                <option> 1 </option>
                                                <option>2 </option>
                                                <option> 3 </option>
                                            </select>
                                            <span class="m-form__help">
                                                Beri Penilaian
                                            </span>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Ulasan :
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control m-input" type="text" rows="3" name="keterangan"></textarea>
                                            <span class="m-form__help">
                                                Beri Ulasan
                                            </span>
                                        </div>
                                    </div>                         
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-6">
                                                <button type="button" class="btn btn-primary m-btn m-btn--custom">
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