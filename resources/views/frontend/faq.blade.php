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
					<h4 class="title">FAQ</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="./"><i class="fas fa-home"></i> Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							@if(Request::get('ref'))
								<a href="{{ route('faq') }}?ref={{Request::get('ref')}}">FAQ</a>
							@else
								<a href="{{ route('faq') }}">FAQ</a>
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
					<div class="calculator-box"> </div>
				</div>
			</div>
		</div>
	</div>
	<!-- Calculator Area End -->

	<!--================ Faq Area =================-->
	<section class="faq_area">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">Chat Our Agent To Assist Your Basic Need</h5>
						<h2 class="title extra-padding">Frequently Asked Questions </h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group faq-accordion">
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="btn-accordion" aria-expanded="true" role="button" aria-controls="collapse1">
										<span class="pluse">+</span><span class="minus">-</span>WHERE CAN I VIEW ALL MY TRADE HISTORY?
									</a>
								</h4>
							</div>
							<div id="collapse1" class="collapse show" aria-expanded="true" role="tabpanel">
								<div class="card-block panel-body">Duplicates of trade made on your account are reported/provided to your contact email/web account you can see it on the deposit history page. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="btn-accordion collapsed" aria-expanded="false" aria-controls="collapse2">
										<span class="pluse">+</span><span class="minus">-</span>WHAT IS BITCOIN?
									</a>
								</h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse" aria-expanded="false" role="tabpanel">
								<div class="panel-body">Bitcoin is a digital currency created in January 2009 following the housing market crash. It follows the ideas set out in a whitepaper by the mysterious and pseudonymous Satoshi Nakamoto. The identity of the person or persons who created the technology is still a mystery. Bitcoin offers the promise of lower transaction fees than traditional online payment mechanisms and is operated by a decentralized authority, unlike government-issued currencies. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="btn-accordion collapsed" aria-expanded="false">
										<span class="pluse">+</span><span class="minus">-</span>WHAT IS THE MINIMUM AGE REQUIREMENT TO TRADE?
									</a>
								</h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse" aria-expanded="false" role="tabpanel">
								<div class="panel-body">Here at {{ $setting->site_name }} , as a rule, customers must be 18 or over to trade. Our regulatory body requires that no customers under the age of 18 shall be allowed to open an account and we strictly enforce this. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="btn-accordion collapsed" aria-expanded="false">
										<span class="pluse">+</span><span class="minus">-</span>WHEN AM I DUE TO WITHDRAW?
									</a>
								</h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse" aria-expanded="false" role="tabpanel">
								<div class="panel-body">This depends on the period, as specified on your investment plan. Each package is unique and has specified time limit to access profit. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="btn-accordion collapsed" aria-expanded="false">
										<span class="pluse">+</span><span class="minus">-</span>HOW LONG DOES IT TAKE TO SEND MY PROFIT?
									</a>
								</h4>
							</div>
							<div id="collapse5" class="collapse" aria-expanded="true" role="tabpanel">
								<div class="card-block panel-body">On completion of the withdrawal process, your money will be sent to you within 24 hours with the method you choose. We provides efficient and guaranteed withdrawals, and if withdrawals will take time, clients are informed prior to time. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" class="btn-accordion collapsed" aria-expanded="false">
										<span class="pluse">+</span><span class="minus">-</span>HOW TO MAKE A DEPOSIT?
									</a>
								</h4>
							</div>
							<div id="collapse6" class="panel-collapse collapse" aria-expanded="false" role="tabpanel">
								<div class="panel-body">You can use any of the available payment options to make your investment deposit. As specified on the deposit page. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" class="btn-accordion collapsed" aria-expanded="false">
										<span class="pluse">+</span><span class="minus">-</span>I HAVE MADE A DEPOSIT, BUT IT'S NOT CREDITED TO MY ACCOUNT?
									</a>
								</h4>
							</div>
							<div id="collapse7" class="panel-collapse collapse" aria-expanded="false" role="tabpanel">
								<div class="panel-body">It may take up to 48 hours for your account to show your deposit. However, if you don't see your deposit even after 48 hours, contact us with the screenshot of transaction as a proof of deposit and your account will be credited after successful verification. </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" role="tab">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" class="btn-accordion collapsed" aria-expanded="false">
										<span class="pluse">+</span><span class="minus">-</span>HOW MUCH RISK SHOULD I TAKE?
									</a>
								</h4>
							</div>
							<div id="collapse8" class="panel-collapse collapse" aria-expanded="false" role="tabpanel">
								<div class="panel-body">The shorter your timescale, the fewer risks you can afford to take. You should never invest money in the stock market that you may need in the next few years, as that does not give you enough time to recover from a market crash. {{ $setting->site_name }} is a place to start and start getting your returns immediately. </div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ Faq Area =================-->

    <!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection