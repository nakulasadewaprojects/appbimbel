@extends('layouts.mentor') 
@section('content')
<div class="m-content">
<div class="row">
    <div class="col-xl-10   ">
<!--begin::Portlet-->
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Form Upload Tutorial
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form class="m-form m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">
                            Form:
                        </h3>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">
                            Id Modul:
                        </label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control m-input" >                           
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">
                               Nama Modul:
                            </label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control m-input" >                           
                            </div>
                        </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">
                            Tanggal Upload:
                        </label>
                        <div class="col-lg-6">
                                <input class="form-control m-input" type="datetime-local" name="end" id="example-datetime-local-input">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">
                                Mentor:
                            </label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control m-input">                           
                            </div>
                        </div>
                    <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-2 col-sm-15">
                                File Upload
                            </label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="m-dropzone dropzone m-dropzone--primary" action="inc/api/dropzone/upload.php" id="m-dropzone-two">
                                    <div class="m-dropzone__msg dz-message needsclick">
                                        <h3 class="m-dropzone__msg-title">
                                            Drop files here or click to upload.
                                        </h3>
                                        <span class="m-dropzone__msg-desc">
                                            Upload up to 10 files
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Jenjang Pendidikan :
                                </label>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control m-input" >                           
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Mata Pelajaran:
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="email" class="form-control m-input">                           
                                    </div>
                        </div>                   
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-6">
                            <button type="reset" class="btn btn-primary">
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
    </div>                                             
</div> 
</div>                             
@endsection