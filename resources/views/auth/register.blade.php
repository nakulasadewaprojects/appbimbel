@extends('layouts.app') 
@section('content')

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login"
            style="background-image: url(../media/background/bg-3.jpg);">
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
                                        <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                Persyaratan Mentor
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    &times;
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                            <p>
                                                                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                                Saya Setuju
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <form class="m-login__form m-form" method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group m-form__group">
                                            <!--                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pengguna') }}</label>-->

                                            <div class="form-group m-form__group">
                                                <input id="username" type="text" placeholder="Nama Pengguna" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                    name="username" value="{{ old('username') }}" required autofocus>
                                                <font size="2">*Username minimal 6 karakter kombinasi huruf & angka</font> @if ($errors->has('username'))

                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span> @endif
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <!--                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Depan') }}</label>-->

                                            <!--                            <div class="col-md-6">-->
                                            <input id="first_name" type="text" placeholder="Nama Depan" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                name="first_name" value="{{ old('first_name') }}" required autofocus>                                            @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span> @endif
                                            <!--                            </div>-->
                                        </div>

                                        <div class="form-group m-form__group">
                                            <!--                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>-->

                                            <!--                            <div class="col-md-6">-->
                                            <input id="last_name" type="text" placeholder="Nama Belakang" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                name="last_name" value="{{ old('last_name') }}" autofocus>                                            @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span> @endif
                                            <!--                            </div>-->
                                        </div>
                                        <br>
                                        <div class="form-group m-form__group">
                                            <label for="last_name" class="col-md-5 ">Jenis Kelamin</label>
                                            <!--                            <div class="col-md-8 col-form-label">-->
                                            <label class="m-radio m-radio--bold m-radio--state-brand">
                                                    <input required type="radio" name="gender" id="male" value="1" @if(old('gender')==1) checked @endif>
                                                    Laki-Laki&nbsp;
                                                    <span></span>
                                            </label>
                                            <label class="m-radio m-radio--bold m-radio--state-brand">
                                                    <input required type="radio" name="gender" id="female" value="2" @if(old('gender')==2) checked @endif>
                                                    Perempuan
                                                    <span></span>
                                            </label>
                                            <!--                            </div>-->
                                        </div>


                                        <div class="form-group m-form__group">
                                            <!--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Surel') }}</label>-->

                                            <!--                            <div class="col-md-6">-->
                                            <input id="email" type="email" placeholder="Alamat Surel" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" value="{{ old('email') }}" required>                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                                            <!--                            </div>-->
                                        </div>

                                        <div class="form-group m-form__group">
                                            <!--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>-->

                                            <!--                            <div class="col-md-6">-->
                                            <input id="password" type="password" placeholder="Kata Sandi" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" required>
                                            <font size="2">*Password minimal 8 karakter kombinasi huruf & angka</font> @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                            <!--                            </div>-->
                                        </div>

                                        <div class="form-group m-form__group">
                                            <!--                            <label for="password-confirm"  class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Kata Sandi') }}</label>-->

                                            <!--                            <div class="col-md-6">-->
                                            <input id="password-confirm" type="password" placeholder="Konfirmasi Kata Sandi" class="form-control" name="password_confirmation"
                                                required>
                                            <!--                            </div>-->
                                        </div><br><br>
                                        <div class="form-group m-form__group">
                                            <label class="m-checkbox  m-checkbox--focus">
                                                    <input class="form-check-input" type="checkbox" required>
                                                    {{ __('Saya sudah membaca persyaratan mentor ')}}
											     <span></span>
                                                </label>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-target="#m_modal_1" data-toggle="modal" href="#m_modal_1">Baca persyaratan</a>
                                        
                                            <div class="m-login__form-action">
                                            <!--                            <div class="col-md-6 offset-md-4">-->
                                            <button id="m_login_signup_submit" type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
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

                </div>
            </div>
        </div>
    </div>
    
</body>
@endsection