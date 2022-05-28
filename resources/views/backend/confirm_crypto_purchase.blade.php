@php 
$pageTitle = "Confirm Crypto Purchase";
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
                        <li class="breadcrumb-item"><a href="{{route('crypto-purchase')}}">Crypto Purchase</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Confirm Crypto Purchase</a></li>
					</ol>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="text-center">Deposit Invoice - <b>{{ $cryptoPurchase->unique_id  }}</b> </h3>  
                                    <hr>   
                                </div>
                                <div class="col-lg-12">
                                    <p class="text-center"> 
                                        <small>
                                            <img src="{{ asset('backend/images/used/box-1.png') }}"> 
                                            <br>
                                            <span style="font-size: 30px;">
                                                <strong>Amount: {{ number_format($cryptoPurchase->amount_to_pay) }} {{$cryptoPurchase->system_wallet->wallet_name}}</strong>
                                            </span>
                                        </small>
                                    </p>
                                    <hr>   
                                </div>
                                <div class="col-lg-12">
                                    <div class="p-2">
                                        <h4 class="text-center">
                                            <strong>
                                                <span>=====PAY TO OUR WALLETS ======</span>
                                            </strong>
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-center mb-3">
                                                <p class="mb-2">
                                                    <b>{{ strtoupper($cryptoPurchase->coin_to_pay) }}  Wallet To Pay To:</b>
                                                </p>
                                                <span>
                                                    <input readonly type="text" value="{{$cryptoPurchase->system_wallet->wallet_address}}" class="form-control" id="copyWallet">
                                                    <button class="btn btn-dark" onclick="processWalletCopy()">Copy & Paste Wallet</button>
                                                </span>
                                            </div>   
                                        </div>
                                        <div class="alert alert-danger">
                                            <h3 class="text-center text-success">Please for {{$cryptoPurchase->system_wallet->wallet_name}} transactions, send through the <b>TRC20</b> network, failure to do this might result to loss of funds</h3>
                                            <hr>
                                            <h3 class="text-center">Do not make payment to anyone or any {{ $cryptoPurchase->system_wallet->wallet_name }} wallet address that isn't the one provided above on your dashboard.</h3>
                                        <p>&nbsp;</p>
                                        </div>
                                        
                                        
                                        <h4 class="text-center">
                                            <strong>====== How to pay with {{ $cryptoPurchase->system_wallet->wallet_name }}  =====</strong>
                                        </h4>
                                        <ol>
                                            <li><strong>Get a Wallet:</strong>&nbsp;First you'll need a {{ $cryptoPurchase->system_wallet->wallet_name }} wallet – an app that lets you receive, hold, and spend {{ $cryptoPurchase->system_wallet->wallet_name }} .</li>
                                            
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
                                    <form action="{{ route('upload-proof', $cryptoPurchase->unique_id ) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="thumbnail">Payment Proof</label>
                                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Upload Payment</button>
                                    </form>
                                    <hr>  
                                </div>
                                <div class="col-lg-12">
                                    <div class="mt-3 pb-3 text-center">
                                        <strong> 
                                            <small><img src="{{ asset('backend/images/used/ac-7.png') }}"> Status</small> 
                                            <br>
                                            <span class="h2 Pending">{{ $cryptoPurchase->received_status }}</span> 
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