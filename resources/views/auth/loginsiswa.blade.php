@extends('layouts.app') 
@section('content')

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../media/background/bg-3.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="{{url('/')}}">
								<img src="{{ asset('media/logo/logo-1.png') }}">
							</a>
                    </div>
                    <div class="container">
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    LOGIN SISWA
                                </h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="m-login__form m-form" action="{{ route('loginsiswa') }}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <input id="email" type="text" placeholder="Email atau Nama Pengguna" name="email" class="form-control m-input{{ $errors->has('email') || $errors->has('username') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') ?: old('username') }}" required autofocus>                                        @if ($errors->has('email') || $errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') ?: $errors->first('username') }}</strong>
                                            </span> @endif

                                    </div>
                                    <div class="form-group m-form__group">
                                        <input id="password" type="password" placeholder="Kata Sandi" name="password" class="form-control m-input m-login__form-input--last{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required> @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span> @endif
                                    </div>
                                    <div class="row m-login__form-sub">
                                        <div class="col m--align-left m-login__form-left">
                                            <label class="m-checkbox  m-checkbox--focus">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    {{ __('Ingat Saya')}}
											     <span></span>
                                                </label>
                                        </div>
                                        <div class="col m--align-right m-login__form-right">
                                            <a href="{{ route('password.request') }}" id="m_login_forget_password" class="m-link">
											     {{ __('Lupa Kata Sandi Anda ?') }}
                                                </a> @if (Route::has('password.request'))
                                        </div>
                                    </div>

                                    <a class="btn btn-link" href="{{ route('password.request') }}"> </a> @endif
                                    <div class="m-login__form-action">
                                        <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary"
                                            type="submit">
										      {{ __('Login') }}
									       </button>
                                    </div>

                                </form>
                                <div class="m-login__account">
                                    <span class="m-login__account-msg">
                                      Belum punya akun ?
                                  </span> &nbsp;&nbsp;
                                    <a href="register" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                                      Daftar
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

</body>