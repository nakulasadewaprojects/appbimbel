@extends('layouts.siswa')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--head-sm" data-portlet="true" id="m_portlet_tools_2">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tutorial
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            @foreach ($modul as $md)
                            {{-- <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img src="assets/app/media/img/files/doc.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Metronic Documentation
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon">
                                    <i class="la la-download"></i>
                                </a>
                            </div>
                        </div> --}}
                            {{-- <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img src="assets/app/media/img/files/jpg.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Make JPEG Great Again
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon">
                                    <i class="la la-download"></i>
                                </a>
                            </div>
                        </div> --}}
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--icon">
                                    <img src="assets/app/media/img/files/pdf.svg" alt="" id="myPDF">
                                    <a target="_blank" href="{{ url('/data_modul/'.$md->file) }}">{{$md->nama_modul}}<a />

                                </div>
                                <div class="m-widget4__info">
                                    <span class="m-widget4__text">
                                        @if($md->matpel==1)
                                        Bhs. Indonesia
                                        @elseif($md->matpel==2)
                                        Matematika
                                        @elseif($md->matpel==3)
                                        IPA
                                        @elseif($md->matpel==4)
                                        IPS
                                        @else
                                        IPS
                                        @endif

                                        untuk
                                        @if($md->jenjangpendidikan==1)
                                        SD
                                        @elseif($md->jenjangpendidikan==2)
                                        SMP
                                        @elseif($md->jenjangpendidikan==3)
                                        SMA
                                        @else
                                        SMK
                                        @endif
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img src="assets/app/media/img/files/javascript.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Make JS Great Again
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon">
                                    <i class="la la-download"></i>
                                </a>
                            </div>
                        </div> --}}
                            {{-- <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img src="assets/app/media/img/files/zip.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Download Ziped version OF 5.0
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon">
                                    <i class="la la-download"></i>
                                </a>
                            </div>
                        </div> --}}
                            {{-- <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img src="assets/app/media/img/files/pdf.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Finance Report 2016/2017
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon">
                                    <i class="la la-download"></i>
                                </a>
                            </div>
                        </div> --}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div></div>
@endsection