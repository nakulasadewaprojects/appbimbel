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
                                   Form Upload Tutorial
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--label-align-right" action="http://localhost/appbimbel/public/datatutorial/updatetutorial" method="POST" enctype="multipart/form-data">
					    {{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                            
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Nama Modul:
                                    </label>
                                    <div class="col-lg-6">
                                         <input type="hidden" name="id"  value="{{$tutorial->idmodul}}" >
                                        <input type="text" name="nama"class="form-control m-input"  value="{{$tutorial->nama_modul}}">
                                    </div>
                                </div>
                                
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Mata Pelajaran:
                                    </label>
                                    <div class="col-lg-6">
                                        {{-- <select class="form-control m-bootstrap-select m_selectpicker" name="matpel"> --}}
                                        <select class="form-control m-input" name="matpel" type="text" id="matpel">
                                            <option value="">Pilih Mata Pelajaran </option>                                                
                                        @foreach ($matpel as $mp)
                                        <option value="{{ $mp->idMasterMatpel}}" {{$tutorial->matpel == $mp->idMasterMatpel ? 'selected' : ''}} > {{ $mp->MatPel}}</option>
                                        @endforeach	
                                </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Jenjang Pendidikan :
                                    </label>
                                    <div class="col-lg-6">
                                        {{-- <select class="form-control m-bootstrap-select m_selectpicker" name="jenjang"> --}}
                                        <select class="form-control m-input" name="jenjang" type="text" id="jenjang">
                                                <option value="">Pilih Jenjang </option>
                                                @foreach ($jenjang as $jp)
                                                <option value="{{$jp->idMasterPendidikan}}" {{$tutorial->jenjangpendidikan == $jp->idMasterPendidikan ? 'selected' : ''}} > {{ $jp->jenjangPendidikan}}</option>
												@endforeach	 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-2 col-sm-15">
                                        File Upload
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        {{-- <div class="m-dropzone dropzone m-dropzone--success" action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                <h3 class="m-dropzone__msg-title">
                                                    Drop files here or click to upload.
                                                </h3>
                                                <span class="m-dropzone__msg-desc">
                                                    Only image, pdf and psd files are allowed for upload
                                                </span>
                                            </div>
                                        </div> --}}
                                        <input type="file" name="modul" accept="application/pdf" class="form-control m-input"  value="{{$tutorial->file}}">                                        
                                        <span class="m-form__help">
                                               *Upload File PDF max 2 mb
                                            </span>
                                    </div>
									@if($tutorial->file!=null)
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class" id="myPDF">
                                            <a target="_blank" href="{{ url('/data_modul/'.$tutorial->file) }}">{{$tutorial->nama_modul}}"<br>
                                                @if($tutorial->matpel==1)
                                                Bhs. Indonesia
                                                @elseif($tutorial->matpel==2)
                                                Matematika
                                                @elseif($tutorial->matpel==3)
                                                IPA
                                                @elseif($tutorial->matpel==4)
                                                IPS
                                                @else
                                                Bhs. Iggris
                                                @endif
                                                Untuk
                                                @if($tutorial->jenjangpendidikan==1)
												SD
												@elseif($tutorial->jenjangpendidikan==2)
												SMP
												@elseif($tutorial->jenjangpendidikan==3)
												SMA
												@else
												SMK
												@endif
                                                <a />
                                        </div>
                                    </div>
                                    @else Anda Belum Upload File Ijazah @endif
                                </div>
                                
                                <br>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-7">
                                                <button type="submit" class="btn btn-primary m-btn m-btn--custom">
                                                    Simpan
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
@endsection>
                                   
                                
                                