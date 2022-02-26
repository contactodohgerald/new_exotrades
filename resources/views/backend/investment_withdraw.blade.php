@php 
$pageTitle = "Withdraw Investment Page";
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Emergency Cashout</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Withdraw Investment</a></li>
					</ol>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                            <form action="{{ route('withdraw_invest', $invest->unique_id ) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="text-center">NOTICE :</h3>
                                        <hr>     
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="alert alert-success">
                                            <p class="text-center">You Investment is still active and it's unwise to place/intiate a withdrawal at this time. <br><b>Note!</b> A service fee of <b>{{$appSettings->withdrawal_penalty}}%</b> will be charged for this request</p>
                                         </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr>
                                        <h3 class="text-center">Current Plan Type : <b>{{ $invest->plans->plan_name }} PLAN</b></h3>
                                        <p class="text-center">Amount Invested : <b>$ {{ number_format($invest->amount) }} </b></p>
                                        <p class="text-center">Duration : <b>{{ $invest->no_of_days }} Days</b></p>
                                        <hr>     
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
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="alert alert-warning text-center">
                                            <p>please naviagte to the <a href="{{ route('edit-profile') }}">settings page</a> to set up your wallet address correctly to avoid loss of funds</p>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Place Withdrawal Invoice</button>
                                </div>
                            </form>
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

</body>

</html>