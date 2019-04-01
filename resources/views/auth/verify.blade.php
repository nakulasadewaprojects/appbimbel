@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifikasi alamat email Anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima email') }}, <a href="{{ route('verification.resend') }}">{{ __('klik di sini untuk kirim ulang') }}</a>.
                    <br><br>
                    <b>Batas waktu verifikasi: <br></b>
                    {{Carbon\Carbon::parse($name->limitAktivasi)->isoFormat('dddd')}},     
                    {{Carbon\Carbon::parse($name->limitAktivasi)->format('j F Y')}} pukul 
                    {{Carbon\Carbon::parse($name->limitAktivasi)->format('H:i')}} WIB
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
