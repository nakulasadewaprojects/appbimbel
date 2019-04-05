@extends('layouts.app') 
@section('content')
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(media/background/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{ asset('media/logo/logo-1.png') }}">
							</a>
                        </div>
                        <div class="container">
                            <div class="m-login__signin">
                            <div class="m-login__signin">
                                <div class="m-login__head"> 
                                    <h3 class="m-login__title">
                                        {{ __('Pendaftaran Siswa') }}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('registerSiswa')}}" method="POST" >
		                                {{ csrf_field() }}

                                        <div class="form-group m-form__group">
                                            <input type="text" id="inputUsername" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username"  value="{{ old('username') }}" required autofocus>
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert"> 
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span> 
                                                @endif  
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input type="password" id="inputPassword" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" value="{{ old('password') }}"required>
                                                <font size="2">*Password minimal 8 karakter kombinasi huruf & angka</font>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span> 
                                                    @endif
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input id="password-confirm" type="password" placeholder="Konfirmasi Password" class="form-control" name="password_confirmation" required>
                                        </div>
                                        <div class="form-group m-form__group">
                                                <input type="text" id="inputNamaLengkap" name="NamaLengkap" class="form-control{{ $errors->has('NamaLengkap') ? ' is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ old('NamaLengkap') }}" required>  
                                                    @if ($errors->has('NamaLengkap'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('NamaLengkap') }}</strong>
                                                        </span> 
                                                    @endif
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="last_name" class="col-md-5 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
                                                <input type="radio" name="gender" value="1" required> Pria &nbsp;&nbsp;
                                                <input type="radio" name="gender" value="2" required> Wanita  
                                        </div>
                                        <div class="form-group m-form__group">
                                                <input type="text" id="inputNoTlpn" name="NoTlpn" class="form-control{{ $errors->has('NoTlpn') ? ' is-invalid' : '' }}" placeholder="No Telepon" value="{{ old('NoTlpn') }}" required>
                                                @if ($errors->has('NoTlpn'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('NoTlpn') }}</strong>
                                                    </span> 
                                                @endif 
                                        </div>
                                        <div class="form-group m-form__group">
                                                <input type="email" id="inputEmail" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" required > <br/>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span> 
                                                @endif 
                                        </div>

                                        <div class="m-login__form-action">
                                            <button id="m_login_signup_submit" type="submit" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                                                {{ __('Daftar') }}
                                            </button>
                                        </div>
                                    </form>
                                
                                </div>
                                </div>
                            </div>
                        </div>
@endsection     
                </div>
            </div>
        </div>
    </div>
 
</body>
