@php 
$pageTitle = "Home Page";
@endphp

@include('includes.head')

<body>

    <!--*******************
        Preloader start
    ********************-->
   @include('includes.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
       @include('includes.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-4 mb-md-5 align-items-start">
					<div class="input-group search-area d-inline-flex">
						<div class="input-group-append">
							<span class="input-group-text"><i class="flaticon-381-search-2"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Search here">
					</div>
					@if (auth()->user()->account_type == 'user')
						<a href="{{ route('invest') }}" class="btn btn-primary ml-auto">+ Invest</a>
					@endif
				</div>
				@if (auth()->user()->account_type == 'user')
				<div class="row">
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header d-flex border-0 pb-0">
								<h3> <img src="{{asset('favicon.png') }}" width="25" height="25" alt=""> <span>Deposit</span></h3>
								<a href="{{route('earnings-history')}}" class="btn-info" style="padding: 5px">View</a>
							</div>
							<hr>
							<div class="card-body border-bottom tab-content" style="padding-top: 0">
								<div class="align-items-center">
									<p class="text-black">Last:</p>
									<h3 class="fs-20 font-w600 text-black ml-auto">${{($invest == null)? '0' : number_format($invest->amount)}}</h3>
								</div>
								<div class="progress rounded-0">
									<div class="progress-bar rounded-0 bg-primary progress-animated" style="width: 90%; height:12px;" role="progressbar">
										<span class="sr-only">60% Complete</span>
									</div>
								</div>
								<div class="d-flex align-items-center">
									<p class="text-black">Total:</p>
									<h3 class="fs-20 font-w600 text-black ml-auto">${{number_format($user_total_invest)}}</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header d-flex border-0 pb-0">
								<h3> <img src="{{asset('favicon.png') }}" width="25" height="25" alt=""> <span>Earnings</span></h3>
								<a href="{{route('investment-history')}}" class="btn-info" style="padding: 5px">View</a>
							</div>
							<hr>
							<div class="card-body border-bottom tab-content" style="padding-top: 0">
								<div class="align-items-center">
									<p class="text-black">Last:</p>
									<h3 class="fs-20 font-w600 text-black ml-auto">${{($earnings == null) ? '0' : number_format($earnings->amount)}}</h3>
								</div>
								<div class="progress rounded-0">
									<div class="progress-bar rounded-0 bg-primary progress-animated" style="width: 39%; height:12px;" role="progressbar">
										<span class="sr-only">60% Complete</span>
									</div>
								</div>
								<div class="d-flex align-items-center">
									<p class="text-black">Total:</p>
									<h3 class="fs-20 font-w600 text-black ml-auto">${{number_format($user_total_earnings)}}</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header d-flex border-0 pb-0">
								<h3> <img src="{{asset('favicon.png') }}" width="25" height="25" alt=""> <span>Withdraw</span></h3>
								<a href="{{route('withdrawal-history')}}" class="btn-info" style="padding: 5px">View</a>
							</div>
							<hr>
							<div class="card-body border-bottom tab-content" style="padding-top: 0">
								<div class="align-items-center">
									<p class="text-black">Last:</p>
									<h3 class="fs-20 font-w600 text-black ml-auto">${{($withdraw == null) ? '0':number_format($withdraw->amount)}}</h3>
								</div>
								<div class="progress rounded-0">
									<div class="progress-bar rounded-0 bg-primary progress-animated" style="width: 60%; height:12px;" role="progressbar">
										<span class="sr-only">60% Complete</span>
									</div>
								</div>
								<div class="d-flex align-items-center">
									<p class="text-black">Total:</p>
									<h3 class="fs-20 font-w600 text-black ml-auto">${{number_format($user_total_withdraw)}}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 ">
						<div class="owl-bank-wallet owl-carousel owl-loaded owl-drag mb-sm-4 mb-0">
							<div class="items">
								<div class="card-bx bg-danger">
									<img class="pattern-img" src="{{asset('backend/images/pattern/pattern1.png')}}" alt="">
									<div class="card-info text-white">
										<div class="d-flex align-items-center mb-3">
											<img class="cr-logo mr-auto" src="{{asset('backend/images/svg/crypto-logo.svg')}}" alt="">
											<p class="mb-0">Main Balance</p>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="mb-3">
													<p class="fs-10 mb-2">Main Balance</p>
													<h3 class="text-white">$ {{ number_format($user->main_balance) }} </h3>
												</div>
											</div>
										</div>
										<div class="d-flex align-items-center">
											<img src="{{ asset('backend/images/dot.svg') }}" class="dots-img ml-auto" alt="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12 col-xll-12 col-lg-12">
						<div class="table-responsive" style="overflow-x: auto;">
							<!-- TradingView Widget BEGIN -->
							<div class="tradingview-widget-container">
								<div class="tradingview-widget-container__widget"></div>
								<div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/currencies/forex-cross-rates/" rel="noopener" target="_blank"><span class="blue-text" style="display: none;">Forex Rates</span></a> by TradingView</div>
								<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
									{
										"width": 1100,
										"height": 400,
										"currencies": [
										"EUR",
										"USD",
										"JPY",
										"GBP",
										"CHF",
										"AUD",
										"CAD",
										"NZD",
										"CNY",
										"TRY",
										"SEK",
										"NOK",
										"DKK",
										"ZAR",
										"HKD",
										"SGD",
										"THB",
										"MXN",
										"IDR",
										"KRW",
										"PLN",
										"ISK",
										"KWD",
										"PHP",
										"MYR",
										"INR",
										"TWD",
										"SAR",
										"RUB",
										"ILS"
									],
										"isTransparent": false,
										"colorTheme": "dark",
										"locale": "en"
									}
								</script>
							</div>
							<!-- TradingView Widget END -->
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body p-0">
								<div class="media p-4 top-up-bx col-sm-6 align-items-center">
									<div class="media-body">
										<h3 class="fs-20 text-white">INVEST</h3>
										<p class="text-white font-w200 mb-0 fs-14">Invest</p>
									</div>
									<a href="{{ route('invest') }}" class="icon-btn ml-3">
										<svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5.9375 6.23198L5.9375 24.875C5.9375 25.6689 6.58107 26.3125 7.375 26.3125C8.16892 26.3125 8.8125 25.6689 8.8125 24.875L8.8125 6.23201L11.2311 8.66231L11.2311 8.66232C11.7911 9.22502 12.7013 9.22719 13.264 8.66716C13.8269 8.107 13.8288 7.1968 13.2689 6.6342L12.9145 6.98689L13.2689 6.63419L8.3939 1.73557L8.38872 1.73036L8.38704 1.72877C7.82626 1.17279 6.92186 1.17467 6.36301 1.72875L6.36136 1.73031L6.35609 1.73561L1.48109 6.63424L1.48108 6.63425C0.921124 7.19694 0.9232 8.10708 1.48597 8.66719C2.04868 9.22724 2.95884 9.22508 3.51889 8.66237L3.51891 8.66235L5.9375 6.23198Z" fill="#6418C3" stroke="#6418C3"></path>
										</svg>
									</a>
								</div>
								<div class="media p-4 withdraw-bx col-sm-6 align-items-center">
									<div class="media-body">
										<h3 class="fs-20 text-white">INITIATE WITHDRAW</h3>
										<p class="text-white font-w200 mb-0 fs-14">Initiate Withdrawal</p>
									</div>
									<a href="{{ route('funds-withdrawal') }}" class="icon-btn ml-3">
										<svg width="27" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5.9375 20.768L5.9375 2.125C5.9375 1.33108 6.58107 0.6875 7.375 0.6875C8.16892 0.6875 8.8125 1.33108 8.8125 2.125L8.8125 20.768L11.2311 18.3377L11.2311 18.3377C11.7911 17.775 12.7013 17.7728 13.264 18.3328C13.8269 18.893 13.8288 19.8032 13.2689 20.3658L12.9145 20.0131L13.2689 20.3658L8.3939 25.2644L8.38872 25.2696L8.38704 25.2712C7.82626 25.8272 6.92186 25.8253 6.36301 25.2712L6.36136 25.2697L6.35609 25.2644L1.48109 20.3658L1.48108 20.3658C0.921124 19.8031 0.9232 18.8929 1.48597 18.3328C2.04868 17.7728 2.95884 17.7749 3.51889 18.3376L3.51891 18.3377L5.9375 20.768Z" fill="#6418C3" stroke="#6418C3"></path>
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xl-12 col-xll-12 col-lg-12">
						<div class="table-responsive" style="overflow-x: auto;">
							<!-- TradingView Widget BEGIN -->
							<div class="tradingview-widget-container">
								<div id="tradingview_6e19a"></div>
								<div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>
								<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
								<script type="text/javascript">
									new TradingView.widget(
										{
											"width": 980,
											"height": 610,
											"symbol": "NASDAQ:AAPL",
											"interval": "D",
											"timezone": "Etc/UTC",
											"theme": "dark",
											"style": "1",
											"locale": "en",
											"toolbar_bg": "#f1f3f6",
											"enable_publishing": false,
											"allow_symbol_change": true,
											"container_id": "tradingview_6e19a"
										}
									);
								</script>
							</div>
							<!-- TradingView Widget END -->
						</div>
					</div>
				</div>

				@else
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-primary text-primary">
										<!-- <i class="ti-user"></i> -->
										<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">TOTAL USERS</p>
										<h4 class="mb-0">{{ count($user_count) }}</h4>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="widget-stat card">
							<div class="card-body  p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-danger text-danger">
										<svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
											<line x1="12" y1="1" x2="12" y2="23"></line>
											<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">TOTAL INVESTMENT</p>
										<h4 class="mb-0">$ {{ number_format($all_invest_amount) }}</h4>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-success text-success">
										<svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
											<ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
											<path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
											<path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">CONFIRM INVESTMENT</p>
										<h4 class="mb-0">$ {{ number_format($confirm_invest_amount) }}</h4>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card bg-danger">
							<div class="card-body  p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-calendar-1"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">PAYOUT REQUEST</p>
										<h3 class="text-white">$ {{ number_format($pending_withdraw) }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-diamond"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">SETTLED REQUEST</p>
										<h3 class="text-white">$ {{ number_format($confirmed_withdraw) }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-heart"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">TOTAL PAYOUT REQUEST</p>
										<h3 class="text-white">$ {{ number_format($all_withdraw) }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>

					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<h4 class="card-title">ALL INTEREST</h4>
								<h3>$ {{  number_format($interest_amount) }}</h3>
							</div>
						</div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<h4 class="card-title">CONFIRMED INTEREST</h4>
								<h3>$  {{  number_format($comfirm_interest_amount) }}</h3>
							</div>
						</div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<h4 class="card-title">SUPPORT TICKET</h4>
								<h3>0</h3>
							</div>
						</div>
                    </div>
					
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="la la-user"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">ALL REFERRAL COMISSION</p>
										<h3 class="text-white">$  {{ number_format($all_ref_comission) }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card bg-secondary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="la la-graduation-cap"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">CONFIRMED REFERRAL COMISSION</p>
										<h3 class="text-white">$  {{ number_format($confrim_ref_comission) }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-6">
						<div class="widget-stat card bg-danger ">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="la la-dollar"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">PENDING REFERRAL COMISSION</p>
										<h3 class="text-white">$  {{ number_format($unresolve_ref_comission) }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
										
				
				</div>
				@endif
             
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
       @include('includes.footer')
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
   @include('includes.e_script')
	
</body>
</html>