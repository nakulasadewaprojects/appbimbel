@extends('layouts.mentor')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Form Upload Quiz
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--label-align-right" action="http://localhost/appbimbel/public/quiz/input" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">

                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Judul:
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control m-input" name="judul">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                            Deskripsi:
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control m-input" type="text" rows="3" name="deskripsi"></textarea>
                                            <span class="m-form__help">
                                                Tambahkan deskripisi yang anda inginkan
                                            </span>
                                        </div>
                                    </div>
                                     <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-2 col-sm-15">
                                            File Upload
                                        </label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <input type="file" name="quiz" accept="application/pdf" class="form-control m-input">

                                            {{-- <div class="m-dropzone dropzone m-dropzone--success" action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                            <div class="m-dropzone__msg dz-message needsclick">
                                            <input type="file" name="modul" accept="application/pdf" class="form-control m-input" >

                                                <h3 class="m-dropzone__msg-title">
                                                    Drop files here or click to upload.
                                                </h3>
                                                <span class="m-dropzone__msg-desc">

                                                    Only image, pdf and psd files are allowed for upload
                                                </span>
                                            </div>
                                        </div> --}}
                                            {{-- <input type="file" name="modul" accept="application/pdf" class="form-control m-input"> --}}
                                            {{-- <div class="dropzone">
                                                    <div class="fallback">
                                                            <input name="file" type="file" multiple />
                                                          </div>
                                            </div> --}}
                                            {{-- <div id="dropzone">
                                                <div class="dropzone needsclick" id="demo-upload">

                                                    <div class="dz-message needsclick">
                                                    Drop files here or click to upload.<br />
                                                    <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                                                    </div>
                                              
                                                 </div>
                                            </div> --}}
                                            <span class="m-form__help">
                                                *Upload File PDF max 2 mb
                                            </span>
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