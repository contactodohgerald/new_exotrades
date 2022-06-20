@php 
$pageTitle = "Payment Invoice";
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
						<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Account Recovery</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Make Payment</a></li>
					</ol>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="text-center">Recovery Track ID - <b>{{ $accountRecovery->unique_id  }}</b> </h3>  
                                    <hr>   
                                </div>
                                <div class="col-lg-12">
                                    <p class="text-center"> 
                                        <small>
                                            <img src="{{ asset('backend/images/used/box-1.png') }}"> 
                                            <br>
                                            <span style="font-size: 30px;"> 
                                                <strong>Amount ${{ number_format($accountRecovery->amount)  }}</strong>
                                            </span>
                                        </small>
                                    </p>
                                    <hr>   
                                </div>
                                <div class="col-lg-12">
                                    <div class="">
                                        <h4 class="text-center">
                                            <strong>
                                                <span>=====PAY TO OUR WALLETS ======</span>
                                            </strong>
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-center mb-3">
                                                <p class="mb-2"><b>{{ $accountRecovery->system_wallet->wallet_name }} Wallet To Pay To:</b></p>
                                                <span>
                                                    <input readonly type="text" value="{{ $accountRecovery->system_wallet->wallet_address }}" class="form-control" id="copyWallet">
                                                    <button class="btn btn-dark" onclick="processWalletCopy()">Copy & Paste Wallet</button>
                                                </span>
                                            </div> 
                                        </div>      
                                        @if($accountRecovery->system_wallet->wallet_name  == "BITCOIN")                               
                                        <h3 class="text-center">
                                            <span>Amount ${{ number_format($accountRecovery->amount)  }}</span>
                                            <br>
                                            <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:{{ $accountRecovery->system_wallet->wallet_address }}?amount=<?php echo sprintf('%.08f', $accountRecovery->amount);?>"> 
                                        </h3>
                                        @endif
                                        <div class="alert alert-danger">
                                            @if($accountRecovery->system_wallet->wallet_name == "USDT")
                                            <h3 class="text-center text-success">Please for USDT transactions, send through the <b>TRC20</b> network, failure to do this might result to loss of funds</h3>
                                            <hr>
                                            @endif
                                            <h3 class="text-center">Do not make payment to anyone or any {{ $accountRecovery->system_wallet->wallet_name  }} wallet address that isn't the one provided above on your dashboard.</h3>
                                        <p>&nbsp;</p>
                                        </div>
                                        
                                        
                                        <h4 class="text-center">
                                            <strong>====== How to pay with {{ $accountRecovery->system_wallet->wallet_name  }} =====</strong>
                                        </h4>
                                        <ol>
                                            <li><strong>Get a Wallet:</strong>&nbsp;First you'll need a {{ $accountRecovery->system_wallet->wallet_name  }} wallet - an app that lets you receive, hold, and spend {{ $accountRecovery->system_wallet->wallet_name  }}.</li>
                                            
                                            <li><strong>Make a payment</strong>:&nbsp;Making a blockchain payment is fast, convenient, and extremely secure.&nbsp;</li>
                                        </ol>
                                        
                                        <ul>
                                            <li><strong>Our payment system is automated it takes only 2 confirmation for your deposit to appear on your dashboard</strong></li>
                                            <li><strong>In cases if network problem or other related issues, Our team of experts will review and credit you accordingly&nbsp;</strong></li>
                                        </ul>
                                  
                                    </div>
                                    <hr>  
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="text-center">
                                        <strong>====== Upload Payment Proof =====</strong>
                                    </h4>
                                    <form action="{{ route('upload/recovery/proof', $accountRecovery->unique_id ) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="thumbnail">Payment Proof</label>
                                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Upload Proof</button>
                                    </form>
                                    <hr>  
                                </div>
                                <div class="col-lg-12">
                                    <div class="mt-3 pb-3 text-center">
                                        <strong> 
                                            <small><img src="{{ asset('backend/images/used/ac-7.png') }}"> Status</small> 
                                            <br>
                                            <span class="h2 Pending">{{ $accountRecovery->status }}</span> 
                                        </strong>
                                        <hr>
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
            alert("Wallet Copied! " + copyText.value);
        }
    </script>

</body>

</html>