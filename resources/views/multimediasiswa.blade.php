@extends('layouts.siswa')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    @if (DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('statusKomplit')!==4)
    <div class="m-alert m-alert--icon alert alert-primary" role="alert">
        <div class="m-alert__icon">
            <i class="la la-warning"></i>
        </div>
        <div class="m-alert__text">
            <strong>
                Luar biasa!
            </strong> Silakan lengkapi profil Anda agar dapat mesen mentor.
        </div>
        <div class="m-alert__actions" style="width: 160px;">
            <a class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide" href="myprofilesiswa">Lengkapi Sekarang</a>
        </div>
    </div>
    @endif

    <div class="m-content">

        <div class="col-xl-13">
            <!--begin:: Widgets/Download Files-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Download Files
                            </h3>
                        </div>
                    </div>
                    
                </div>
                <div class="m-portlet__body">
                    <!--begin::m-widget4-->
                    <div class="m-widget4">
                        <div class="m-widget4__item">
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
                        </div>
                        <div class="m-widget4__item">
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
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img src="assets/app/media/img/files/pdf.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Full Deeveloper Manual For 4.7
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon">
                                    <i class="la la-download"></i>
                                </a>
                            </div>
                        </div>
                        <div class="m-widget4__item">
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
                        </div>
                        <div class="m-widget4__item">
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
                        </div>
                        <div class="m-widget4__item">
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
                        </div>
                    </div>
                    <!--end::Widget 9-->
                </div>
            </div>
            <!--end:: Widgets/Download Files-->
        </div>
        <!--End::Main Portlet-->
    </div>
</div>
</div>
@endsection