@php 
$pageName = 'World Leading Cryptocurrency Platform'; 
$headerValue = '';
@endphp

@extends('layouts.design')

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


@section('content')   

    <!-- Hero Area Start -->
    <div class="hero-area partical-area">
		<div id="particles-js"></div>
		<div class="container">
			<div class="row ">
				<div class="col-lg-10 d-flex align-self-center">
					<div class="left-content">
						<div class="content text-center">
							<h5 class="subtitle">Instant, Secure and Private</h5>
							<h1 class="title">Let The Experts Do The Trading While You Earn Big</h1>
							<p class="text-white">Invest Now And Get Unimaginable Returns, Use Modern Progressive Technologies of Bitcoin To Earn Money.</p>
							<div class="links">
								@if(Request::get('ref'))
									<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1 link1"><span>Get Started</span> </a>
									<a href="{{ route('about') }}?ref={{Request::get('ref')}}" class="mybtn1 link2"><span>Learn More</span> </a>
								@else
									<a href="{{ route('register') }}" class="mybtn1 link1"><span>Get Started</span> </a>
									<a href="{{ route('about') }}" class="mybtn1 link2"><span>Learn More</span> </a>
								@endif
							</div>
						</div>
					</div>
				</div>
                {{-- <div class="col-lg-6 order-first order-lg-last">
					<div class="right-img">
						<img src="{{ asset('frontend/assets/images/hero.png') }}" alt="{{ env('APP_NAME') }}">
					</div>
				</div> --}}
			</div>
		</div>
	</div>
	<!-- Hero Area End -->

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
	</section>
	<!-- About Us Area Start -->

	<!-- Lend Area Start -->
	<section class="lend">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle extra-padding">Tracking Crypto Prices Made Easy</h5>
						<h2 class="title">Cyptocurrency Prices and Ranks</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-lend" role="tabpanel" aria-labelledby="pills-lend-tab">
							<ul>
								<div style="height:433px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:70px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38; padding: 0px; margin: 0px; width: 100%;">
									<div style="height:413px; padding:0px; margin:0px; width: 100%;">
										<iframe src="https://widget.coinlib.io/widget?type=full_v2&amp;theme=light&amp;cnt=6&amp;pref_coin_id=1505&amp;graph=yes" width="100%" height="900" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe>
									</div>
									<div style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
										<a href="https://coinlib.io/" target="_blank" style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px"></a>&nbsp;
									</div>
								</div>
								<div class="poweredBy" style="font-family: Arial, Helvetica, sans-serifutm_source=WMT&amp;utm_medium=referral&amp;utm_campaign=TOP_CRYPTOCURRENCIES&amp;utm_content=Footer%20Link" target="_blank" rel="nofollow">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Lend Area End -->

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

	<!-- fact Area Start -->
	<section class="fact">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-10">
					<div class="section-heading">
						<h2 class="title">Complete package for every traders</h2>
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
											<li>MAX Deposit: <b> {{ $each_plan->max_amount}}</b></li>
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

	<!-- How it work Area Start -->
	<section class="how-it-work">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 single-work">
					<div class="section-heading">
						<h2 class="title">Company Certificate</h2>
					</div>
					<div class="single-works">
						<p>Now you can start trading Bitcoin, Ethereum and many cryptocurrencies fast, easily and safely from where ever you are. With great margin trading leverage and short sell options available with quick deposit & withdrawal capability, you can start trading with us in seconds.</p>
						<div class="certified animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.1s" style="animation-delay: 0.3s; visibility: visible;">
							<img src="{{ asset('frontend/assets/images/used/award.png') }}"/>
							<div class="certified-details">
								<h5>Company Address</h5>
								<p>{{ $setting->site_address }} </p>
								<div class="certified animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.1s" style="animation-delay: 0.3s; visibility: visible;">
									<img src="{{ asset('frontend/assets/images/used/award.png') }}"/>
									<div class="certified-details">
										<h5>Company Number</h5>
										<p>#901130</p>
									</div>
								</div>
							
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="download-img">
						<img src="{{ asset('frontend/assets/images/used/certificate.png') }}">
						<a class="mybtn1 link1" data-animation="fadeInUp" data-animation-delay="0.4s" href="{{ asset('frontend/assets/images/used/certificate.png') }}" download style="animation-delay: 0.4s; visibility: visible;">
									<span class="ion-android-download"></span>Download Certificate
									<i class="ion-ios-arrow-thin-right"></i>
								</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- How it work Area End -->

	<!-- Get Start Area Start -->
	<section class="get-start">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="left-image">
						<img src="{{ asset('frontend/assets/images/get-start.png') }}" alt="{{ env('APP_NAME') }}">
					</div>
				</div>
				<div class="col-lg-7">
					<div class="rihgt-area">
						<div class="section-heading">
							<h5 class="subtitle extra-padding">REFERAL COMMISION</h5>
							<h2 class="title  extra-padding">1 Level Affiliate Program</h2>
							<p class="">In addition to your earnings on your deposit, you are able to share the investment opportunity within your community and earn more from their deposits. The more referral you given to Dacaminvestment, more commission you earn.</p>
							<p>We have only one level referral programs for you, through which you can earn upto 10% referral commission.</p>
							@if(Request::get('ref'))
								<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1">Become a Member</a>
							@else
								<a href="{{ route('register') }}" class="mybtn1">Become a Member</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Get Start Area End -->

	<!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

	<div class="tradingview-widget-container">
		<div id="tradingview_82a7a">
			<div id="tradingview_2fe8c-wrapper" style="position: relative;box-sizing: content-box;width: 100%;height: calc(600px - 32px);margin: 0 auto !important;padding: 0 !important;font-family:Arial,sans-serif;">
				<div style="width: 100%;height: calc(600px - 32px);background: transparent;padding: 0 !important;">
					<iframe id="tradingview_2fe8c" src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_2fe8c&amp;symbol=COINBASE%3ABTCUSD&amp;interval=D&amp;symboledit=1&amp;saveimage=1&amp;toolbarbg=f1f3f6&amp;studies=%5B%5D&amp;theme=light&amp;style=1&amp;timezone=Etc%2FUTC&amp;studies_overrides=%7B%7D&amp;overrides=%7B%7D&amp;enabled_features=%5B%5D&amp;disabled_features=%5B%5D&amp;locale=en&amp;utm_source=bitcoin-aspire.com&amp;utm_medium=widget_new&amp;utm_campaign=chart&amp;utm_term=COINBASE%3ABTCUSD" style="width: 100%; height: 100%; margin: 0 !important; padding: 0 !important;" frameborder="0" allowtransparency="true" scrolling="no" allowfullscreen=""></iframe>
				</div>
			</div>
		</div>
		<div class="tradingview-widget-copyright" style="width: 100%;">
			<a href="https://www.tradingview.com/symbols/COINBASE-BTCUSD/" rel="noopener" target="_blank">
				<span class="blue-text">BTCUSD Chart</span>
			</a> by <?php print @$siteName?>
		</div>
		<script type="text/javascript" src="s3.tradingview.com/tv.js"></script>
		<script type="text/javascript">
			new TradingView.widget(
				{
					"width": 100%,
					"height": 100%,
					"symbol": "COINBASE:BTCUSD",
					"interval": "D",
					"timezone": "Etc/UTC",
					"theme": "dark",
					"style": "1",
					"locale": "en",
					"toolbar_bg": "#f1f3f6",
					"enable_publishing": false,
					"allow_symbol_change": true,
					"container_id": "tradingview_82a7a"
				}
			);
		</script>
	</div>

	<!-- Testimonial Area Start -->
	<section class="testimonial mb-3">
		<div class="testimonial-top-area">
			<img class="shape" src="{{ asset('frontend/assets/images/testi-shape.png') }}" alt="{{ env('APP_NAME') }}">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 d-flex align-self-center">
						<div class="left-area">
							<div class="section-heading">
								<p class="subtitle extra-padding">
									<b>Open an account for free and start trading Bitcoins!</b>
								</p>
								<h4 class="title extra-padding">GET STARTED TODAY WITH CRYPTOCURRENCY</h4>
								<p class="">Bitcoin is one of the most important inventions in all of human history. For the first time ever, anyone can send or receive any amount of money with anyone else, anywhere on the planet, conveniently and without restriction. It’s the dawn of a better, more free world.</p>
								@if(Request::get('ref'))
									<a href="{{ route('register') }}?ref={{Request::get('ref')}}" class="mybtn1">GET STARTED</a>
								@else
									<a href="{{ route('register') }}" class="mybtn1">GET STARTED</a>
								@endif
							</div>
						</div>
					</div>
					<div class="col-lg-5 d-flex align-self-center">
						<div class="right-img">
							<img src="{{ asset('frontend/assets/images/mercury3.png') }}" alt="{{ env('APP_NAME') }}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Testimonial Area End -->
	
@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection