@php 
$pageName = 'World Leading Cryptocurrency Platform'; 
$headerValue = 'inner-page';
@endphp

@extends('layouts.design')

@section('extra_style')
@section('extra_style')
    <style>
		.single-fun {
			padding-top: 75px;
			padding-bottom: 75px;
		}
		.single-fun .plan-title {
			color: #282828;
    		font-family: 'Exo 2', sans-serif;
    		font-weight: 700;
    		margin: 0 0 28px;
        	margin-bottom: 0;
    		line-height: 1;
			font-size: 42px;
		}	
		.single-fun .plan-primary-title {
			color: #c99c3b !important;
			font-size: 42px;
    		font-family: 'Exo 2', sans-serif;
			font-weight: 700;
			margin: 0 0 28px;
			line-height: 1;
		}
		.single-fun ul {
			padding: 0;
			list-style: none;
			margin-bottom: 20px;
			margin-top: 0;
		}
		.single-fun ul li {
			padding-left: 35px;
			position: relative;
		}		
		.single-fun ul li::before {
			background-image: none;
			position: absolute;
			width: 1.5em;
			height: 1.5em;
			font-size: 16px;
			font-family: 'Font Awesome 5 Free';
			font-weight: 900;
			content: "\f058";
			color: #1e87f0;
			top: 0px;
			left: 4px;
		}
		.ending{
			border: #E46D12 solid 1px;
			background: #F6FDF9;
		}
		.certified {
			padding-left: 75px;
			position: relative;
			margin-top: 30px;
			margin-bottom: 30px;
		}
	</style>
@endsection
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

	<!-- fact Area Start -->
	<section class="fact">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-10">
					<div class="section-heading">
						<h2 class="title">Our Investment <span class="text-danger">Plans</span></h2>
					</div>
				</div>
			</div>
			<div class="row">
				@if (count($plan) > 0)
					@foreach ($plan as $each_plan)
						@if ($each_plan->plan_name !== 'CONTRACT')
							<div class="col-lg-4 col-md-4 col-12 mt-3">
								<div class="single-fun ">
									<center>
										<h2 class="plan-title">{{ $each_plan->plan_name }}</h2>
										<h2 class="plan-primary-title">{{ $each_plan->plan_percentage }}% <br> {{ $each_plan->payment_interval }}</h2>
										<hr>
										<ul class="uk-list uk-list-bullet">
											<li>MIN Deposit: <b>$ {{ number_format($each_plan->min_amount) }}</b></li>
											<li>MAX Deposit: <b>$ {{ number_format($each_plan->max_amount) }}</b></li>
											<hr>
											<li><b>{{ $setting->ref_bonus }}%</b> 1<sup>st</sup> Level Referral Bonus</li>
											<li><b>{{ $setting->ref_bonus }}%</b> 2<sup>nd</sup>  Level Referral Bonus</li>
											<li>Withdrawals Payout: <b>Fridays</b></li>
											<li>Capital withdrawal: <b>{{ $setting->capital_payment_duration }} Days</b></li>
											<li>24/7 Live Support</li>
										</ul>
										@if(Request::get('ref'))
											<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1 link1">
										@else
											<a href="{{ route('register') }}" class="mybtn1 link1">
										@endif
											Open an account
											<i class="fas fa-chevron-circle-right fa-xs uk-margin-small-left"></i>
										</a>
									</center>
								</div>
							</div>
						@else
							<div class="col-lg-6 col-md-6 col-12 mt-3">

							</div>
							<div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-12 mt-3">
								<div class="single-fun ending">
									<center>
										<h2 class="plan-title">{{ $each_plan->plan_name }}</h2>
										<h2 class="plan-primary-title">{{ $each_plan->plan_percentage }}% <br> {{ $each_plan->payment_interval }}</h2>
										<hr>
										<ul class="uk-list uk-list-bullet">
											<li>MIN Deposit: <b>$ {{ number_format($each_plan->min_amount) }}</b></li>
											<li>MAX Deposit: <b> {{ $each_plan->max_amount }}</b></li>
											<hr>
											<li><b>{{ $setting->ref_bonus }}%</b> 1<sup>st</sup> Level Referral Bonus</li>
											<li><b>{{ $setting->ref_bonus }}%</b> 2<sup>nd</sup>  Level Referral Bonus</li>
											<li>Withdrawals Payout: <b>Fridays</b></li>
											<li>Capital withdrawal: <b>{{ $setting->capital_payment_duration }} Days</b></li>
											<li>24/7 Live Support</li>
										</ul>
										@if(Request::get('ref'))
											<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1 link1">
										@else
											<a href="{{ route('register') }}" class="mybtn1 link1">
										@endif
											Open an account
											<i class="fas fa-chevron-circle-right fa-xs uk-margin-small-left"></i>
										</a>
									</center>
								</div>
							</div>
						@endif
					@endforeach
				@endif			
			</div>
		</div>
	</section>
	<!-- fact Area End -->

    <!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection