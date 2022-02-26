@php 
$pageTitle = "Swap Coin Page";
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

        <div class="content-body">
			<div class="container-fluid">
                <div class="row">
					<div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-4 ">
						<div class="card currency-bx overflow-hidden relative bg-danger">
							<div class="card-body p-4">
								<div class="media align-items-center">
									<div class="media-body">
										<h5 class="text-white fs-20">Bitcoin Wallet</h5>
										<h1 class="text-white mb-0">$ {{ number_format($wallet->btc_balance + $wallet->btc_interest_balance) }}</h1>
									</div>
									<div class="currency-icon">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45" height="45" x="0px" y="0px" fill="#ffab2d" viewBox="0 0 512 512"><g><g><path d="M296,272h-16h-88v80h104c22.048,0,40-17.952,40-40C336,289.952,318.048,272,296,272z"></path></g></g><g><g><path d="M280,160h-88v80h88c22.048,0,40-17.952,40-40C320,177.952,302.048,160,280,160z"></path></g></g><g><g><path d="M256,0C114.624,0,0,114.624,0,256s114.624,256,256,256s256-114.624,256-256S397.376,0,256,0z M296,384h-8v16 c0,8.832-7.168,16-16,16c-8.832,0-16-7.168-16-16v-16h-32v16c0,8.832-7.168,16-16,16c-8.832,0-16-7.168-16-16v-16h-16 c-8.832,0-16-7.168-16-16V144c0-8.832,7.168-16,16-16h16v-16c0-8.832,7.168-16,16-16c8.832,0,16,7.168,16,16v16h32v-16 c0-8.832,7.168-16,16-16c8.832,0,16,7.168,16,16v16.8c35.904,4.032,64,34.24,64,71.2c0,19.392-7.776,36.928-20.288,49.856 C353.28,262.336,368,285.344,368,312C368,351.712,335.68,384,296,384z"></path></g></g></svg>
									</div>
								</div>
							</div>
							<img class="bg-img" src="images/money/bitcoin.svg" alt="">
						</div>
					</div>
					<div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-4 ">
						<div class="card currency-bx overflow-hidden relative bg-success">
							<div class="card-body p-4">
								<div class="media align-items-center">
									<div class="media-body">
										<h5 class="text-white fs-20">Etherum Wallet</h5>
										<h1 class="text-white mb-0">$ {{ number_format($wallet->eth_balance + $wallet->eth_interest_balance) }}</h1>
									</div>
									<div class="currency-icon">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45" height="45" fill="#dc3ccc" viewBox="0 0 512 512"><g><g><path d="M256,0C114.624,0,0,114.624,0,256s114.624,256,256,256s256-114.624,256-256S397.376,0,256,0z M272,366.72V384
										c0,8.832-7.168,16-16,16c-8.832,0-16-7.168-16-16v-17.344c-16.384-2.688-31.392-9.376-42.624-19.328
										c-6.624-5.888-7.2-15.968-1.344-22.592c5.856-6.624,15.968-7.168,22.592-1.344C227.648,331.392,241.28,336,256,336
										c26.016,0,48-14.656,48-32s-21.984-32-48-32c-44.096,0-80-28.704-80-64c0-30.912,27.52-56.768,64-62.72V128
										c0-8.832,7.168-16,16-16c8.832,0,16,7.168,16,16v17.344c16.384,2.688,31.392,9.376,42.624,19.328
										c6.592,5.888,7.232,16,1.344,22.592s-15.968,7.168-22.592,1.344C284.352,180.608,270.72,176,256,176c-26.016,0-48,14.656-48,32
										s21.984,32,48,32c44.128,0,80,28.704,80,64C336,334.912,308.48,360.768,272,366.72z"></path></g></g></svg>

									</div>
								</div>
							</div>
							<img class="bg-img" src="images/money/dollar.svg" alt="">
						</div>
					</div>
					<div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-4 ">
						<div class="card currency-bx overflow-hidden relative bg-secondary">
							<div class="card-body p-4">
								<div class="media align-items-center">
									<div class="media-body">
										<h5 class="text-white fs-20">USDT Wallet Balance</h5>
										<h1 class="text-white mb-0">$ {{ number_format($wallet->usdt_balance + $wallet->usdt_interest_balance) }}</h1>
									</div>
									<div class="currency-icon">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45" height="45" fill="#319bd7" viewBox="0 0 512 512"><g><g><path d="M256,0C114.624,0,0,114.624,0,256s114.624,256,256,256s256-114.624,256-256S397.376,0,256,0z M272,208
										c8.832,0,16,7.168,16,16c0,8.832-7.168,16-16,16h-78.656c-0.736,5.216-1.344,10.528-1.344,16s0.608,10.784,1.344,16H256
										c8.832,0,16,7.168,16,16c0,8.832-7.168,16-16,16h-52.864c13.856,28.544,39.392,48,68.864,48c13.952,0,27.072-4.128,39.008-12.256
										c7.264-4.928,17.248-3.104,22.208,4.192c4.96,7.296,3.104,17.248-4.224,22.24C311.904,377.824,292.192,384,272,384
										c-46.88,0-87.008-33.184-103.68-80H144c-8.832,0-16-7.168-16-16c0-8.832,7.168-16,16-16h17.408
										c-0.576-5.312-1.408-10.528-1.408-16s0.832-10.688,1.408-16H144c-8.832,0-16-7.168-16-16c0-8.832,7.168-16,16-16h24.32
										c16.672-46.816,56.8-80,103.68-80c20.192,0,39.904,6.176,56.992,17.824c7.328,4.992,9.184,14.944,4.224,22.24
										c-4.96,7.36-14.976,9.152-22.208,4.192C299.072,164.128,285.952,160,272,160c-29.472,0-55.008,19.456-68.864,48H272z"></path></g></g></svg>
									</div>
								</div>
							</div>
							<img class="bg-img" src="images/money/euro.svg" alt="">
						</div>
					</div>
				</div>
				<form action="{{ route('swap-coin') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
							<hr>
							<h2 class="text-center">==SWAP COIN==</h2>
							<hr>
						</div>
						<div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
							<div class="form-group">
								<label for="from_coin">From</label>
								<select name="from_coin" id="from_coin" class="form-control" required>
									<option value="">----Choose Wallet Type----</option>
									<option value="BTC">Bitcoin ({{ number_format($wallet->btc_balance + $wallet->btc_interest_balance) }})</option>
									<option value="ETH">Etherum ({{ number_format($wallet->eth_balance + $wallet->eth_interest_balance) }})</option>
									<option value="USDT">USDT ({{ number_format($wallet->usdt_balance + $wallet->usdt_interest_balance) }})</option>
								</select>
							</div>
						</div>
						<div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
							<div class="form-group">
								<label for="to_coin">To</label>
								<select name="to_coin" id="to_coin" class="form-control" required>
									<option value="">----Choose Wallet Type----</option>
									<option value="BTC">Bitcoin ({{ number_format($wallet->btc_balance + $wallet->btc_interest_balance) }})</option>
									<option value="ETH">Etherum ({{ number_format($wallet->eth_balance + $wallet->eth_interest_balance) }})</option>
									<option value="USDT">USDT ({{ number_format($wallet->usdt_balance + $wallet->usdt_interest_balance) }})</option>
								</select>
							</div>
						</div>
						<div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
							<div class="form-group">
								<label for="amount">Amount ($)</label>
								<input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required>
							</div>
						</div>
						<div class="col-lg-12 mt-2">
							<button class="btn btn-primary" type="submit">Swap Coin</button>
						</div>
					</div>
				</form>
            </div>
        </div>

        <!--**********************************
            Footer start
        ***********************************-->
        @include('includes.footer')
        <!--**********************************
            Footer end
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