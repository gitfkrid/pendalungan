<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login - Pendalungan Megah Solusi</title>
        <link href="{{ asset('public/assets/img/logo/icon.svg') }}" rel="icon">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link href="{{ asset('public/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('public/assets/login/css/style.css')}}">
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Pendalungan Megah Solusi</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url({{asset('public/assets/login/images/bg.jpg')}});"></div>
						<div class="login-wrap p-2 p-md-5">
			            <div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4 text-center">Sign In</h3>
			      		</div>
			      	</div>
                <form method="POST" action="{{ route('login') }}" class="signin-form">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password" required autocomplete="current-password">
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                    </div>
		        </form>
		        </div>
            </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('public/assets/login/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/login/js/popper.js')}}"></script>
    <script src="{{asset('public/assets/login/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/login/js/main.js')}}"></script>
	</body>
</html>

