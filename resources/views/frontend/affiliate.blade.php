@php 
$pageName = 'World Leading Cryptocurrency Platform'; 
$headerValue = 'inner-page';
@endphp

@extends('layouts.design')

@section('extra_style')
    
@endsection

@section('content')

	<!-- Breadcrumb Area Start -->
	<section class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="title">
						Affiliate
					</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="./l"><i class="fas fa-home"></i >Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							@if(Request::get('ref'))
								<a href="{{ route('affiliate') }}?ref={{Request::get('ref')}}">Affiliate</a>
							@else
								<a href="{{ route('affiliate') }}">Affiliate</a>
							@endif
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Area End -->

	<!-- Calculator Area Start -->
	<div class="calculator mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="calculator-box"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Calculator Area End -->

	<!-- Affiliate Info Area Start -->
	<section class="affiliat-info-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">Start A Great</h5>
						<h2 class="title extra-padding"> Affiliate Partnership</h2>
						<p class="">Make {{ $setting->refferral_link }}% commissions for lifetime by joining our free lendbo Affiliate Program.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 d-flex align-self-end">
					<div class="img">
						<img src="{{ asset('frontend/assets/images/affiliate/patner.png') }}" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<h4 class="heading">
						Why Choose {{ $setting->site_name }}?
					</h4>
					<ul class="list">
						<li>
							<p>
								<img src="{{ asset('frontend/assets/images/check.png')}}" alt="{{ env('APP_NAME') }}">Become An Affiliate For Free
							</p>
						</li>
						<li>
							<p>
								<img src="{{ asset('frontend/assets/images/check.png')}}" alt="{{ env('APP_NAME') }}">Generate Your Custom URL
							</p>
						</li>
						<li>
							<p>
								<img src="{{ asset('frontend/assets/images/check.png')}}" alt="{{ env('APP_NAME') }}">Share Your URL Everywhere
							</p>
						</li>
						<li>
							<p>
								<img src="{{ asset('frontend/assets/images/check.png')}}" alt="{{ env('APP_NAME') }}">Track Earnings & Get Paid
							</p>
						</li>
					</ul>
					@if(Request::get('ref'))
						<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1"> explore Now!</a>
					@else
						<a href="{{ route('register') }}" class="mybtn1"> explore Now!</a>
					@endif
				</div>
			</div>
			<div class="row invoice-area">
				<div class="col-lg-6">
					<h4 class="heading"> Simplest Process To Get Involved </h4>
					<p class=""> When you sign up for our {{ $setting->site_name }}, we’ll automatically create an account for you and provide a referral link so you can share through an ad, post, email, or tweet. Email swipes and banner ads are included so you can get started right away. </p>
					@if(Request::get('ref'))
						<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1">Join Now!</a>
					@else
						<a href="{{ route('register') }}" class="mybtn1">Join Now!</a>
					@endif
				</div>
				<div class="col-lg-6">
					<div class="img">
						<img src="{{ asset('frontend/assets/images/affiliate/invoice.png') }}" alt="{{ env('APP_NAME') }}">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Affiliate Info Area End -->

	<!-- Affiliate Info Area Start -->
	<section class="affiliate-video-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="video-box">
						<a href="https://www.youtube.com/watch?v=Gc2en3nHxA4" class="video-play-btn mfp-iframe">
							<i class="fas fa-play"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="row video-content justify-content-center">
				<div class="col-lg-10">
					<div class="section-heading">
						<h2 class="title">
							Earn {{ $setting->refferral_link }}% from each direct referral and {{ $setting->ref_bonus_2 }}% from downliner referral
						</h2>
						<p class=""> Because we believe that you cannot achieve something great alone. And only by empowering others can you make a long lasting impact in people’s lives.</p>
						@if(Request::get('ref'))
							<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1">Apply Now</a>
						@else
							<a href="{{ route('register') }}" class="mybtn1">Apply Now</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Affiliate Info Area End -->

	<!-- Affiliate Benefits Area Start -->
	<section class="affiliate-benefits">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle extra-padding"> Try To Check Out Our</h5>
						<h2 class="title"> Affiliate Benefits</h2>
						<p class="">The World's leading online crypto lending & borrowing affiliate program. Promote {{ $setting->site_name }}  to get {{ $setting->refferral_link }}%  to {{ $setting->ref_bonus_2 }}%  bonus commission</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon1.png') }}" alt="">
						<h4 class="title"> Mentorship from experts </h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon2.png')}}" alt="">
						<h4 class="title">Mentorship from experts</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon3.png')}}" alt="">
						<h4 class="title"> Mentorship from experts</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon4.png')}}" alt="">
						<h4 class="title"> Mentorship from experts</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon5.png')}}" alt="">
						<h4 class="title">Mentorship from experts </h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon6.png')}}" alt="">
						<h4 class="title"> Mentorship from experts </h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon7.png')}}" alt="">
						<h4 class="title">Mentorship from experts</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="benefits-box">
						<img src="{{ asset('frontend/assets/images/affiliate/ab-icon8.png')}}" alt="">
						<h4 class="title">Mentorship from experts </h4>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Affiliate Benefits Area End -->

    <!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection