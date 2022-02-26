	<!-- Header Area Start  -->
	<header class="header {{ $headerValue }}">
		<!-- Top Header Area Start -->
		<section class="top-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content">
							<div class="left-content">
								<ul class="left-list">
									<li>
										<p>
											<i class="fas fa-headset"></i>	Support
										</p>
									</li>
								</ul>
							</div>
							<div class="right-content">
								<ul class="right-list">
									<li>
										<div class="language-selector">
											<div id="google_translate_element" class="language"></div>
										</div>
									</li>
									<li>
										<ul class="social-link">
											<li>
												<a href="#">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fab fa-linkedin-in"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fab fa-instagram"></i>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Top Header Area End -->
		<!--Main-Menu Area Start-->
		<div class="mainmenu-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">                 
						<nav class="navbar navbar-expand-lg navbar-light">
							@if(Request::get('ref'))
								<a class="navbar-brand" href="./?ref={{Request::get('ref')}}">
							@else
								<a class="navbar-brand" href="./">
							@endif
								<img src="{{ asset('logo.png') }}" alt="{{ env('APP_NAME') }}">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse fixed-height" id="main_menu">
								<ul class="navbar-nav ml-auto">
									@if(Request::get('ref'))
										<li class="nav-item">
											<a class="nav-link" href="./?ref={{Request::get('ref')}}">Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{route('about')}}?ref={{Request::get('ref')}}">About</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{route('affiliate')}}?ref={{Request::get('ref')}}">Affiliate</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{route('plan')}}?ref={{Request::get('ref')}}">Plans</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{route('services')}}?ref={{Request::get('ref')}}">Services</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{route('contact')}}?ref={{Request::get('ref')}}">Contact</a>
										</li>
									@else
										<li class="nav-item">
											<a class="nav-link" href="./">Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('about') }}">About</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('affiliate') }}">Affiliate</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('plan') }}">Plans</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('services') }}">Services</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('contact') }}">Contact</a>
										</li>
									@endif
									@auth
									@else
										<li class="nav-item">
											<a class="nav-link" href="{{ route('login') }}">Login</a>
										</li>
									@endauth
								</ul>
								@if (Route::has('login'))
									@auth
										<a href="{{ url('/dashboard') }}" class="mybtn1">Dashboard </a>
									@else
										@if (Route::has('register'))
											@if(Request::get('ref'))
												<a href="{{route('register')}}?ref={{Request::get('ref')}}" class="mybtn1">Get Started </a>
											@else
												<a href="{{route('register')}}" class="mybtn1">Get Started </a>
											@endif
										@endif
									@endauth
								@endif
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!--Main-Menu Area Start-->
	</header>
	<!-- Header Area End  -->