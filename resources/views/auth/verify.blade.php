@extends('layouts.app')
@section('content')

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login"
            style="background-image: url(../media/background/bg-3.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
								<img src="{{ asset('media/logo/logo-1.png') }}">
							</a>
                    </div>

                    <div class="row justify-content-center">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Verifikasi alamat email Anda
                            </h3>
                        </div>
                        <div class="card-body">
                            @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </div>
                            @endif {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }} {{ __('Jika Anda tidak menerima
                            email') }}, <a href="{{ route('verification.resend') }}">{{ __('klik di sini untuk kirim ulang') }}</a>.
                        </div>
                        <font color="red" size="3">
                            <b>Batas waktu verifikasi:  {{Carbon\Carbon::parse($name->limitAktivasi)->isoFormat('dddd')}},
                            {{Carbon\Carbon::parse($name->limitAktivasi)->format('j F Y')}} pukul {{Carbon\Carbon::parse($name->limitAktivasi)->format('H:i')}}
                            WIB</b>
                        </font>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


    <body>