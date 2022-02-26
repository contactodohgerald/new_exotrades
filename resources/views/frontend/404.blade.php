<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="forntEnd-Developer" content="Mamunur Rashid">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ env('APP_NAME') }} - World Leading Cryptocurrency Platform</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.html')}}" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/plugin.css')}}">

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css')}}">
</head>

<body class="home2">
	<!-- preloader area start -->
	<div class="preloader" id="preloader">
		<div class="loader loader-1">
			<div class="loader-outter"></div>
			<div class="loader-inner"></div>
		</div>
	</div>
	<!-- preloader area end -->

	<!-- 404 Area Start -->
	<section class="four-zero-four">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="content">
						<img src="{{ asset('frontend/assets/images/404.png') }}" alt="{{ env('APP_NAME') }}">
						<div class="inner-content">
							<h4 class="title">Oops, <br> Something went wrong !
							</h4>
							<p class="sub-title">
								The page you're looking for no longer exists.
							</p>
							<a href="./" class="mybtn1">
                                <i class="fas fa-angle-double-left"></i> 
                                BACK TO HOME
                            </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- 404 Area End -->

	<!-- jquery -->
	<script src="{{ asset('frontend/assets/js/jquery.js')}}"></script>
	<!-- popper -->
	<script src="{{ asset('frontend/assets/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{ asset('frontend/assets/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{ asset('frontend/assets/js/plugin.js')}}"></script>
	<!-- main -->
	<script src="{{ asset('frontend/assets/js/main.js')}}"></script>
</body>

</html>