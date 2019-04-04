@extends('layouts.app') 
@section('content')
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(media/background/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="{{url('/')}}">
								<img src="{{ asset('media/logo/logo-1.png') }}">
							</a>
                        </div>
                        <div class="container">
    <div class="m-login__signin">
        <div class="m-login__signin">
           
                <div class="m-login__head">
                     <h3 class="m-login__title">
                    {{ __('Pendaftaran Mentor') }}
                    </h3>
                </div>
            
                <div class="card-body">
                    <form class="m-login__form m-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group m-form__group">
<!--                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pengguna') }}</label>-->

                            <div class="form-group m-form__group">
                                <input id="username" type="text" placeholder="Nama Pengguna" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                                    value="{{ old('username') }}" required autofocus> @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group">
<!--                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Depan') }}</label>-->

<!--                            <div class="col-md-6">-->
                                <input id="first_name" type="text" placeholder="Nama Depan" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name"
                                    value="{{ old('first_name') }}" required autofocus> @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span> @endif
<!--                            </div>-->
                        </div>

                        <div class="form-group m-form__group">
<!--                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>-->

<!--                            <div class="col-md-6">-->
                                <input id="last_name" type="text" placeholder="Nama Belakang" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"
                                    value="{{ old('last_name') }}" autofocus> @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span> @endif
<!--                            </div>-->
                        </div>

                        <div class="form-group m-form__group">
                            <label for="last_name" class="col-md-5 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
<!--                            <div class="col-md-8 col-form-label">-->
                                    <input type="radio" name="gender" value="1" required> Pria &nbsp;&nbsp;
                                    <input type="radio" name="gender" value="2" required> Wanita
<!--                            </div>-->
                        </div>


                        <div class="form-group m-form__group">
<!--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Surel') }}</label>-->

<!--                            <div class="col-md-6">-->
                                <input id="email" type="email" placeholder="Alamat Surel" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
<!--                            </div>-->
                        </div>

                        <div class="form-group m-form__group">
<!--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>-->

<!--                            <div class="col-md-6">-->
                                <input id="password" type="password" placeholder="Kata Sandi" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required> <font size="2">*Password minimal 8 karakter kombinasi huruf & angka</font> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
<!--                            </div>-->
                        </div>

                        <div class="form-group m-form__group">
<!--                            <label for="password-confirm"  class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Kata Sandi') }}</label>-->

<!--                            <div class="col-md-6">-->
                                <input id="password-confirm" type="password" placeholder="Konfirmasi Kata Sandi" class="form-control" name="password_confirmation" required>
<!--                            </div>-->
                        </div>

                        <div class="m-login__form-action">
<!--                            <div class="col-md-6 offset-md-4">-->
                                <button id="m_login_signup_submit" type="submit" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                                    {{ __('Daftar') }}
                                </button>
<!--                            </div>-->
                        </div>
                    </form>
                    <div class="m-login__account">
                        <span class="m-login__account-msg">
                          Sudah punya akun ?
                      </span> &nbsp;&nbsp;
                        <a href="login" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                          Masuk
                      </a>
                    </div>
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


