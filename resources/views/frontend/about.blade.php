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
						About Us
					</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="./"><i class="fas fa-home"></i> Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							@if(Request::get('ref'))
								<a href="{{ route('about') }}?ref={{Request::get('ref')}}">About Us</a>
							@else
								<a href="{{ route('about') }}">About Us</a>
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

	<!-- About Us Area Start -->
	<section class="about">
		<div class="about-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="left-area">
							<div class="section-heading">
								<h5 class="subtitle extra-padding">
									Our Journey In a Nutshell
								</h5>
								<h2 class="title">About {{ $setting->site_name }} </h2>
								<p class="">{{ $setting->site_name }} was established by Brian Armstrong, The company have over the years been involved in trading Binary Options and real estate initially, till expansion into Forex and Crypto Currency. The Company provides professional forex and crypto trading services through state-of-art trading platform, which is specially developed for investors’ convenience.</p>
								<p class="">{{ $setting->site_name }} is a cutting edge result of global co-activity and converging of corporate interests on the worldwide level. The way of the organization has been begun from a little relationship of similarly invested individuals in the field of exchanging on general wares, merchandise and enterprises.</p>
								<p class="">Over the past 2 decades, we have grown into a reliable asset management company that is able to consistently give more than 14% of the return on the funds invested by investors.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="right-area">
							<img src="{{ asset('frontend/assets/images/mercury.png')}}" alt="{{env('APP_NAME')}}">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="about-bottom-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="video-box">
							<a href="https://www.youtube.com/watch?v=Gc2en3nHxA4" class="video-play-btn mfp-iframe">
								<i class="fas fa-play"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="short-info">
							<div class="left-area">
								<img src="{{ asset('frontend/assets/images/about-icon1.pn') }}g" alt="">
							</div>
							<div class="right-area">
								<h4 class="title">Our Mission</h4>
								<p class="text">We are working towards a mission in offering an environment-ally sustainable business model to achieve profit on periodic basis. We have partnered with some of the biggest and reputed mining firms to source cloud mining at the best value.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="short-info">
							<div class="left-area">
								<img src="{{ asset('frontend/assets/images/about-icon3.png')}}" alt="">
							</div>
							<div class="right-area">
								<h4 class="title">Our Vision</h4>
								<p class="text">Our vision is to make a biggest and transparent cryptocurrency mining organization in world. With this goal we structured a perfect business model that can be a beneficial to us as well as our investors and stakeholders.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About Us Area Start -->

	<!-- Check Questions Area Start -->
	<section class="check-questions">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5 d-flex align-self-center">
					<div class="left-image">
						<img src="{{ asset('frontend/assets/images/diamond-top.png') }}" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="rihgt-area">
						<div class="section-heading">
							<h5 class="subtitle extra-padding">WHO WE ARE</h5>
							<h2 class="title extra-padding">What We Do</h2>
							<p class="">{{ $setting->site_name }} is engaged with leading Bitcoin mining and crypto currency trading. It has no doubt that market of Bitcoin is incredibly increasing, So we offer our customers different and suitable investment plans tailored to meet the needs of both small and big investors.</p>
							<p class="">>We ensure maximal profit to each of our investors and keep possible risks by effective ways to their investments at the lowest levels. We put all the efforts to secure the deposit of investments upon achieveing maximum business profitability.</p>
							@if(Request::get('ref'))
								<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1">Learn More</a>
							@else
								<a href="{{ route('register') }}" class="mybtn1">Learn More</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Check Questions Area End -->

	<!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection