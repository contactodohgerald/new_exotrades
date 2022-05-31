@php 
$pageTitle = "Funds Withdrawal Page";
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
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Funds Withdrawal</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
							<div class="card-header d-block d-sm-flex border-0 pb-0">
								<div>
									<h4 class="text-black fs-20">My Main Balance</h4>
                                    <hr>
								</div>
							</div>
							<div class="card-body">
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
                                <div class="text-center">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#withdrawFunds"> 
                                        <svg width="27" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.9375 20.768L5.9375 2.125C5.9375 1.33108 6.58107 0.6875 7.375 0.6875C8.16892 0.6875 8.8125 1.33108 8.8125 2.125L8.8125 20.768L11.2311 18.3377L11.2311 18.3377C11.7911 17.775 12.7013 17.7728 13.264 18.3328C13.8269 18.893 13.8288 19.8032 13.2689 20.3658L12.9145 20.0131L13.2689 20.3658L8.3939 25.2644L8.38872 25.2696L8.38704 25.2712C7.82626 25.8272 6.92186 25.8253 6.36301 25.2712L6.36136 25.2697L6.35609 25.2644L1.48109 20.3658L1.48108 20.3658C0.921124 19.8031 0.9232 18.8929 1.48597 18.3328C2.04868 17.7728 2.95884 17.7749 3.51889 18.3376L3.51891 18.3377L5.9375 20.768Z" fill="#6418C3" stroke="#6418C3"></path>
                                        </svg> 
                                        WITHDRAW FUNDS
                                    </button>
                                </div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!-- Modal -->
        <div class="modal fade" id="withdrawFunds">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Funds</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                     <form action="{{ route('create-withdrawal-invoice') }}" method="POST">
                         @csrf
                        <div class="modal-body">
                            <div class="row"> 
                                <div class="col-lg-12 text-center">
                                    <p class="m-0">Available Balance</p>
                                    <h1 class="m-0">${{ number_format($user->main_balance) }}</h1>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="user_wallet_unique_id">Select Wallet Address</label>
                                        <select name="user_wallet_unique_id" id="user_wallet_unique_id" class="form-control" required>
                                            <option value="">Please Select</option>
                                            @if(count($userWallet) > 0)
                                                @foreach($userWallet as $each_wallet)
                                                    <option value="{{$each_wallet->unique_id}}">{{$each_wallet->system_wallet->wallet_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" name="amount" placeholder="Amount" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="alert alert-success text-center">
                                        <p>Please naviagte to the <a href="{{ route('view-user-wallet-page') }}" target="_blank">wallet setup page</a> to set up your wallet address correctly to avoid loss of funds</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Place Withdraw Invoice</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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