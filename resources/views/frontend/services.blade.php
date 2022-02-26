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
					<h4 class="title">Services</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="./"><i class="fas fa-home"></i> Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							@if(Request::get('ref'))
								<a href="{{ route('services') }}?ref={{Request::get('ref')}}">Services</a>
							@else
								<a href="{{ route('services') }}">Services</a>
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
					<div class="calculator-box">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Calculator Area End -->
    
	<!-- Whay Choose us Area Start -->
	<section class="why-choose-us">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle"> The Most Trusted</h5>
						<h2 class="title extra-padding">Why Choose {{ $setting->site_name }} </h2>
						<p class=""> Here are a few reasons why you should choose {{ $setting->site_name }} </p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="{{ asset('frontend/assets/images/why1.png')}}" alt="{{env('APP_NAME')}}">
							</div>
						</div>
						<div class="right">
							<h4 class="title">Protection & Security</h4>
							<p class="">Stop loss and take profit orders will help secure your investment. The system will automatically execute trades to realise gains.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="{{ asset('frontend/assets/images/why2.png')}}" alt="{{env('APP_NAME')}}">
							</div>
						</div>
						<div class="right">
							<h4 class="title">Licensed Exchange</h4>
							<p class="">Our customers perform transactions not only in cryptocurrency, but the major world currencies supported by the system.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="{{ asset('frontend/assets/images/why3.png')}}" alt="{{env('APP_NAME')}}">
							</div>
						</div>
						<div class="right">
							<h4 class="title">Payments</h4>
							<p class="">We payout instantly. All requested payment made are usually processed and paid in the equivalent cryptocurrency invested.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="{{ asset('frontend/assets/images/why4.png')}}" alt="{{env('APP_NAME')}}">
							</div>
						</div>
						<div class="right">
							<h4 class="title">Affiliate</h4>
							<p class="">We are affiliated with top companies in the forex business and we deal also on Real Estate, Forex trading, Gold Mining. We have a deal with our Investments Insurance partners, best in the market from USA which trades in our Business Enterprise portfolio and in return provides insurance services and elite attorneys for us.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="{{ asset('frontend/assets/images/why5.png')}}" alt="{{env('APP_NAME')}}">
							</div>
						</div>
						<div class="right">
							<h4 class="title">24/7 Support</h4>
							<p class="">We guarantee you of our expert support both day and night. All you need is to write to us using the email address provided in below.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="{{ asset('frontend/assets/images/why6.png')}}" alt="{{env('APP_NAME')}}">
							</div>
						</div>
						<div class="right">
							<h4 class="title">Easy to Use Platform</h4>
							<p class="">Our platform was designed in such a way that it's compatible with all devices and easy to navigate.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Whay Choose us Area End -->

    <!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection