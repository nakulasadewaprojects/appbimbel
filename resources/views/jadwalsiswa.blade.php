@extends('layouts.siswa')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Approval
                            </h3>
                        </div>
                    </div>
                    {{-- <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="m-portlet__body">
                    @foreach ($jadwal as $j)
                    <div class="m-widget3">
                        <div class="m-widget3__item">
                            <div class="m-widget3__header">
                                <div class="m-widget3__user-img">
                                    {{-- <img class="m-widget3__img" src="assets/app/media/img/users/user1.jpg" alt=""> --}}
                                    @if($j->foto==NULL)
													<img class="m-widget3__img" src="{{ url('/data_fileSiswa/default_photo_profile.png') }}"/>
													@else
													<img class="m-widget3__img" src="{{ url('/data_file2/'.$j->foto) }}"/></a>
									@endif
                                </div>
                                <div class="m-widget3__info">
                                    <span class="m-widget3__username">
                                        {{$j->nm_depan}} {{$j->nm_belakang}}
                                    </span>
                                    <br>
                                    <span class="m-widget3__time">
                                        {{$j->prodiBimbel}}
                                    </span>
                                </div>
                                <span class="m-widget3__status m--font-info">  
                                    @if($j->statusBimbel==1) 
                                        Pending
                                    @elseif($j->statusBimbel==2)
                                        Approval
                                    @else
                                        Cancel
                                    @endif
                                </span>
                                <a href="detailBimbel/{{$j->NoIDBimbel}}">
                                    <button type="button" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary" data-toggle="modal" data-target="#m_modal_3">
                                        Detail
                                    </button>
                                </a>
                            </div>
                            <div class="m-widget3__body">
                                <p class="m-widget3__text">
                                    {{$j->tglprivate}}, {{$j->days}}, {{$j->start}} - {{$j->end}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection