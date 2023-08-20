<!DOCTYPE html>
<html lang="en">
<head>
	<title>SPK PIP | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('resources/sources/images/favicon.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/sources/login/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('resources/sources/login/images/bg.jpg');">
			<span></span>
            <div class="wrap-login100 p-l-55 p-r-55 p-t-30 p-b-30">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">

                    @csrf
                    
					<span class="login100-form-title p-b-30">
						<img src="{{ asset('resources/sources/images/logo.png') }}">
					</span>
					
{{-- 
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is reauired">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Type your email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div> --}}

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" id="username" placeholder="Type your username" value="{{ old('email') }}" required autocomplete="username" autofocus>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">

					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	{{-- <div id="dropDownSelect1"></div> --}}
	
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('resources/sources/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('resources/sources/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('resources/sources/login/js/main.js') }}"></script>

</body>
</html>