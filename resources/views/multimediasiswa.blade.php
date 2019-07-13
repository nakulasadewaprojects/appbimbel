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
                                Multimedia
                            </h3>
                        </div>
                    </div>
                </div>
                
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            @foreach($multimedia as $m)
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--icon">
                                        
                                    {{-- <img src="assets/app/media/img/files/doc.svg" alt=""> --}}
                                    <video width="200" controls>
                                        <source src="{{ url('/data_multimedia/'.$m->file) }}" type="video/mp4" >
                                    </video>
                                </div>
<!--
                                <div class="m-widget4__info">
                                    <span class="m-widget4__text">
                                        Metronic Documentation
                                    </span>
                                </div>
-->
                                <div class="m-widget4__ext">
                                    <a href="#" class="m-widget4__icon">
                                        <i class="la la-download"></i>
                                    </a>
                                </div>
                                
                            </div>
                            @endforeach
                            </div>
                        </div>

                    </div>
            </div>
        </div>
        </div>
    </div>

</div>
</div>
@endsection