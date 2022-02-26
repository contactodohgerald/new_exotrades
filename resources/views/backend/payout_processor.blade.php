@php 
$pageTitle = "Payout Processor Page";
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Payouts</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Payouts Processor</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $withdraw->users->name }}'s Account Balance:</h4>
                            </div>
                            <div class="card-body">
                                <div class="owl-bank-wallet owl-carousel owl-loaded owl-drag mb-sm-4 mb-0">
									<div class="items">
										<div class="card-bx bg-dark">
											<img class="pattern-img" src="{{asset('backend/images/pattern/pattern1.png')}}" alt="">
											<div class="card-info text-white">
												<div class="d-flex align-items-center mb-3">
													<img class="cr-logo mr-auto" src="{{asset('backend/images/svg/crypto-logo.svg')}}" alt="">
													<p class="mb-0">{{$withdraw->users->name}} Main Balance</p>
												</div>
												<div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <p class="fs-10 mb-2">{{$withdraw->users->name}} Main Balance</p>
                                                            <h3 class="text-white">$ {{ number_format($withdraw->users->main_balance) }} </h3>
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
                                <div class="basic-list-group">
                                    <p class="text-center alert alert-info">Transfer / Send <b>${{ number_format($withdraw->amount) }}</b> worth / equivalent of {{$withdraw->user_wallet->system_wallet->wallet_name}} to the {{$withdraw->user_wallet->system_wallet->wallet_name}} Wallet Address below</p>
                                    <hr>                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-4">
                                            <div class="list-group mb-4 " id="list-tab" role="tablist">
                                                <a class="list-group-item list-group-item-action active text-center" id="list-home-list" data-toggle="list" href="#list-home" role="tab">{{$withdraw->user_wallet->system_wallet->wallet_name}} Wallet</a>                                          
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-8">
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active text-center" id="list-home">
                                                    <div style="border: 1px solid #6418C3;" >
                                                        <h4 style="margin-top: 7px !important" class="text-center"> {{$withdraw->user_wallet->wallet_address}} </h4>
                                                        <input style="display: none" type="text" value="{{$withdraw->user_wallet->wallet_address}}" class="form-control" id="copyWallet">
                                                    </div>
                                                    <button class="btn btn-dark" onclick="processWalletCopy()">Copy & Paste Link</button>
                                                </div>                  
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 text-center mt-4">
                                            <div class="alert alert-danger">
                                                <p><b>Note!</b> Before confirming this withdrawal, ensure you have made payment to the walllet addess provided above. </p>
                                            </div>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#sendUserMail">Notify User To Update their Wallet</button>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#comfirmPayment">Confirm Payment</button>
                                        </div>
                                    </div>
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
        <div class="modal fade" id="comfirmPayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Has User been Paid?</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">By confirming this action it mean you have complete payment to this user that request to be paid. This user will see it on it end that you have consent to have made payment to his wallet on the said amount.</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('confirm-payout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" value="{{$withdraw->unique_id}}" name="uniqueIdToProcess" />
                                    <button class="btn btn-primary" type="submit">Confirm Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="sendUserMail">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Wallet Update Notifier?</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-wallet-mail', $withdraw->unique_id ) }}" method="POST">@csrf
                            <div class="row"> 
                                <div class="col-lg-12">
                                    <p class="text-center alert alert-success">Send <b>{{ $withdraw->users->name }}</b> an email for their {{$withdraw->user_wallet->system_wallet->wallet_name}} wallet address update, to enable payment! </p>
                                    <div class="form-group">
                                        <label for="message">Compose Mail/Message</label>
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Send Mail</button>
                                </div>
                            </div>
                        </form>
                    </div>
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

    <script>
        function processWalletCopy() {
            /* Get the text field */
            var copyText = document.getElementById("copyWallet");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Wallet Address Copied! " + copyText.value);
        }
    </script>

</body>

</html>