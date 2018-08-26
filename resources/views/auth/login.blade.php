@extends('layouts.lo_login')

@section('title') Login @stop

@section('body')
<body class="login-page">
<div class="page-header header-filter">
{{-- <div class="page-header header-filter" style="background-image: url('{{ asset('images/business_desk.jpg') }}'); background-size: cover; background-position: top center;"> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">
                    <form class="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                        <div class="header header-dark-blue text-center btn-tumblr">
                            <img class="mr-auto ml-auto" src="{{asset('images/logo.png')}}" style="width: 190px"/>
							<h6 class="card-title">Project Management System</h6>
                        </div>
                        <div class="card-content">

                            {{--  email  --}}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">email</i>
									</span>
									<div class="form-group is-empty">
										<input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email..." name="email" value="{{ old('email') }}" required autofocus aria-autocomplete="none">
									</div>
									@if ($errors->has('email'))
                                   		 <span class="material-input" role="alert">
                                        	<small class="text-danger">{{ $errors->first('email') }}</small>
                                   		 </span>
									@endif
								</div>
							{{--  end of email  --}}

							{{-- password --}}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<div class="form-group is-empty">
										<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password..." name="password" required>
									</div>
									@if ($errors->has('password'))
                                   			 <span class="material-input text-danger" role="alert">
													<small class="text-danger">{{ $errors->first('password') }}</small>
                                    		</span>
									@endif
								</div>
							{{-- end of password --}}

							{{-- checkbox remember me --}}
								<div class="input-group">
									<div class="checkbox float-right">
										<label for="remember">
											<input type="checkbox" checked name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
											Remember Me
										</label>
									</div>
								</div>
							{{-- end of checkbox remember me --}}

							</div>

							<div class="footer text-center">
								<button type="submit" class="btn btn-info btn-simple btn-wd btn-md">LOGIN</button>
								{{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a> --}}
							</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/all.js')}}"></script>
</body>
@endsection
