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
                                <h4 class="card-title">{{ $withdraw->users->name }}'s Referral Bonus Balance:</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="card currency-bx overflow-hidden relative bg-info">
                                                <div class="card-body p-4">
                                                    <div class="media align-items-center text-center">
                                                        <div class="media-body">
                                                            <h5 class="text-white fs-20">Referral Bonus Balance</h5>
                                                            <h1 class="text-white mb-0">$ {{ number_format($withdraw->users->ref_bonus_balance) }}</h1>
                                                        </div>
                                                        <div class="currency-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45" height="45" fill="#319bd7" viewBox="0 0 512 512"><g><g><path d="M256,0C114.624,0,0,114.624,0,256s114.624,256,256,256s256-114.624,256-256S397.376,0,256,0z M272,208 c8.832,0,16,7.168,16,16c0,8.832-7.168,16-16,16h-78.656c-0.736,5.216-1.344,10.528-1.344,16s0.608,10.784,1.344,16H256
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
                                <form action="{{ route('comfirm-comission-payout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-controll" value="{{$withdraw->unique_id}}" name="uniqueIdToProcess" />
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