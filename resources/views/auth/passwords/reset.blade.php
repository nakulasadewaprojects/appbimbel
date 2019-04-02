@extends('layouts.app')

@section('content')
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(media/background/bg-3.jpg);">
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
                                        Reset Password ?
								    </h3>
                                </div>

                        <div class="card-body">                                                       
							<form class="m-login__form m-form" method="POST" action="{{ route('password.update') }}">
                             @csrf

                             <input type="hidden" name="token" value="{{ $token }}">
                             
							<div class="form-group m-form__group">
                                    <input id="email" type="email" placeholder="emailmu opo?" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}"
                                    required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group m-form__group">
                                    <input id="password" placeholder="passwordmu opo?" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required>
                                <font size="2">*Password minimal 8 karakter kombinasi huruf & angka</font>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                           
                            </div>

                            <div class="form-group m-form__group">                                                    
                                    <input id="password-confirm" placeholder="ini jg" type="password" class="form-control" name="password_confirmation" required>
                               
                            </div>
                    
								<div class="m-login__form-action">
									<button  type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">
                                        Reset Password 
									</button>
									&nbsp;&nbsp;
									
								</div>
                            </form>
                         </div>            
                    </div>
                </div>
            </div>               
        </div>
    </div>
        @endsection
</body>



