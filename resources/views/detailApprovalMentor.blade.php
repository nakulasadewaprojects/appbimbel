@extends('layouts.mentor') 
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <!--Begin::Main Portlet-->
        <div class="row">
            <div class="col-xl-8">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Detail Approval Bimbel
                                </h3>
                            </div>
                        </div>
                        {{-- <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget5_tab1_content" role="tab">
                                        Last Month
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content" role="tab">
                                        last Year
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab3_content" role="tab">
                                        All time
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>

                    <div class="m-portlet__body">
                        <!--begin::Content-->
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
                                <!--begin::m-widget5-->
                                
                                <div class="m-widget5">
                                    <div class="m-widget5__item">
                                        <div class="m-widget5__pic">
                                            @if($detail->fotoProfile==NULL)
                                                <img class="m-widget7__img" src="{{ url('/data_fileSiswa/default_photo_profile.png') }}"/>
                                            @else
                                                <img class="m-widget7__img" src="{{ url('/data_fileSiswa2/'.$detail->fotoProfile) }}"/></a>
                                            @endif
                                            {{-- <img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt=""> --}}
                                        </div>
                                        <div class="m-widget5__content">
                                            <h4 class="m-widget5__title">
                                                {{$detail->NamaLengkap}}
                                            </h4>
                                            <span class="m-widget5__info">
                                                {{$detail->alamat}}, {{$detail->kelurahan}}, {{$detail->kecamatan}}, 
                                                {{$detail->kota}}, {{$detail->provinsi}}
                                            </span>
                                            <div class="m-widget5__info">
                                                    <span class="m-widget5__author">
                                                        Nomor Telepon   :
                                                    </span>
                                                    <span class="m-widget5__info-date m--font-info">
                                                            {{$detail->noTlpn}}
                                                    </span>
                                            </div>
                                            <div class="m-widget5__info">
                                                    <span class="m-widget5__author">
                                                        Email   :
                                                    </span>
                                                    <span class="m-widget5__info-date m--font-info">
                                                            {{$detail->email}}
                                                    </span>
                                            </div>
                                        </div>
                                       
                                        <div class="m-widget5__stats2">
                                            <span class="m-widget5__number">
                                                Siswa
                                            </span>
                                            <br>
                                            <span class="m-widget5__votes">
                                                @if($detail->jenjang==1) 
                                                    SD kelas {{$detail->tingkatPendidikan}}
                                                @elseif($detail->jenjang==2)
                                                    SMP kelas {{$detail->tingkatPendidikan}}
                                                @elseif($detail->jenjang==3)
                                                    SMA kelas {{$detail->tingkatPendidikan}}
                                                @elseif($detail->jenjang==4)
                                                    SMK kelas {{$detail->tingkatPendidikan}}
                                                @elseif($detail->jenjang==5)
                                                    D3 Semester 
                                                @elseif($detail->jenjang==6)
                                                    S1 Semester 
                                                @elseif($detail->jenjang==7)
                                                    S2 Semester
                                                @else
                                                    S3 Semester
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget5__item">
                                        <div class="m-widget5__pic">
                                            <img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
                                        </div>
                                        <div class="m-widget5__content">
                                            <h4 class="m-widget5__title">
                                                Durasi Bimbel
                                            </h4>
                                            <span class="m-widget5__info">
                                                @if($detail->durasi==1)
                                                    Selama {{$detail->durasi}} bulan
                                                @elseif($detail->durasi==6)
                                                    Selama 1 Semester
                                                @else
                                                    Selama 2 Semester
                                                @endif
                                            </span>
                                            <div class="m-widget5__info">
                                                    <span class="m-widget5__author">
                                                        Dari Tanggal   :
                                                    </span>
                                                    <span class="m-widget5__info-date m--font-info">
                                                            {{$detail->startBimbel}}
                                                    </span>
                                            </div>
                                            <div class="m-widget5__info">
                                                        <span class="m-widget5__author">
                                                            Sampai Tanggal   :
                                                        </span>
                                                        <span class="m-widget5__info-date m--font-info">
                                                                {{$detail->endBimbel}}
                                                        </span>
                                            </div>
                                            {{-- <div class="m-widget5__info">
                                                <span class="m-widget5__author">
                                                    
                                                    Dari Tanggal {{$detail->startBimbel}} Sampai {{$detail->endBimbel}}
                                                </span>
                                            </div> --}}
                                        </div>
                                        <div class="m-widget5__stats2">
                                            <span class="m-widget5__number">
                                                Jadwal
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="m-widget5__item">
                                        <div class="m-widget5__pic">
                                            <img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
                                        </div>
                                        <div class="m-widget5__content">
                                            <h4 class="m-widget5__title">
                                               Waktu Bimbel
                                            </h4>
                                            <div class="m-widget5__info">
                                                <span class="m-widget5__author">
                                                    Pada Tanggal:
                                                </span>
                                                <span class="m-widget5__info-date m--font-info">
                                                        {{$detail->tglprivate}}
                                                </span>
                                            </div>
                                            <div class="m-widget5__info">
                                                    <span class="m-widget5__author">
                                                         Hari:
                                                    </span>
                                                    <span class="m-widget5__info-date m--font-info">
                                                            {{$detail->days}}
                                                    </span>
                                                </div>
                                        </div>
                                        <div class="m-widget5__stats1">
                                            <span class="m-widget5__number">
                                                {{$detail->start}}
                                            </span>
                                            <br>
                                            <span class="m-widget5__sales">
                                                Mulai
                                            </span>
                                        </div>
                                        <div class="m-widget5__stats2">
                                            <span class="m-widget5__number">
                                                    {{$detail->end}}
                                            </span>
                                            <br>
                                            <span class="m-widget5__votes">
                                                Selesai
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--end::m-widget5-->
                            </div>
                        </div>
                        <!--end::Content-->
                        {{-- <div class="m-portlet__foot m-portlet__foot--fit"> --}}
                            <form method="POST" action="http://localhost/appbimbel/public/TerimaTolakBimbel">
                                {{ csrf_field() }}
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="id" value="{{$detail->NoIDBimbel}}">
                                        <input type="hidden" name="terima" value="{{$detail->NoIDBimbel}}">
                                        <button type="submit" name="submit" class="btn btn-primary" value="terima">
                                            Terima
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-danger" value="tolak">
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        {{-- </div> --}}
                    </div>
                </div>
                <!--end:: Widgets/Best Sellers-->
            </div>
            
        </div>
        <!--End::Main Portlet-->
    </div>
</div>
</div>
@endsection