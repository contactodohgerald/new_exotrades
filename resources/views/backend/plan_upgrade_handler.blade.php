@php 
$pageTitle = "Upgrade Plan";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Upgrade Plan</a></li>
					</ol>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                            <form action="{{ route('upgrade_plan', $invest->unique_id ) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="text-center">Your Payment Channel :</h3>
                                        <hr>     
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="payment_currency">Payment Type</label>
                                            <select class="form-control " id="system_wallet_id" name="system_wallet_id" required>
                                                <option value="">Please Select</option>
                                                @if(count($systemWallet) > 0)
                                                    @foreach($systemWallet as $each_wallet)
                                                        <option {{($each_wallet->unique_id == $invest->system_wallet_id)? 'selected' : ''}} value="{{$each_wallet->unique_id }}">{{$each_wallet->wallet_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="alert alert-success">
                                                <p class="text-center">
                                                    <b>Select you Preffered mode of payment, please ensure to update your payment detaills in the edit profile page</b>
                                                 </p>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr>
                                        <h3 class="text-center">Current Plan Type : <b>{{ $invest->plans->plan_name }} PLAN</b> </h3>
                                        <hr>     
                                    </div>
                                   
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Proceed To Payment Page</button>
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