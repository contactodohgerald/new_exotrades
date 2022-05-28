@php 
$pageTitle = "Invest Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Invest</a></li>
					</ol>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                            <form action="{{ route('create-payment-invoice') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="text-center">Select Your Preffered Payment Channel</h3>
                                        <hr>     
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <div class="form-group">
                                            <label for="system_wallet_id">Select Payment Type</label>
                                            <select class="form-control " id="system_wallet_id" name="system_wallet_id" required>
                                                <option value="">Please Select</option>
                                                @if(count($systemWallet) > 0)
                                                    @foreach($systemWallet as $each_wallet)
                                                        <option value="{{$each_wallet->unique_id }}">{{$each_wallet->wallet_name}}</option>
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
                                        <h3 class="text-center">Select Your Preffered Plan</h3>
                                        <hr>     
                                    </div>
                                    @if (count($plan) > 0)
                                    @foreach ($plan as $each_plan)
                                        @if($each_plan->plan_name === 'CONTRACT')
                                        <div class="col-lg-6 col-xl-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row m-b-30">
                                                        <div class="col-md-12">
                                                            <div class="new-arrival-content position-relative">
                                                                <h3 class="text-center text-danger">
                                                                    {{ $each_plan->plan_name }}
                                                                    <br>
                                                                    <input name="plan_unique_id" type="radio" style="height: 20px; width: 20px" value="{{ $each_plan->unique_id }}">
                                                                </h3>
                                                                <p class="text-center">Min Amount : <span class="item"> <b>$ {{ number_format($each_plan->min_amount) }}</b></span></p>
                                                                <p class="text-center">Max Amount : <span class="item"> <b>{{ $each_plan->max_amount }}</b></span></p>
                                                                <p class="text-center">Percentage Interest : <span class="item"> <b>{{ $each_plan->plan_percentage }} (%)</b></span> </p> 
                                                                <p class="text-center">Interest Recieve : <span class="item"> <b>{{ $each_plan->payment_interval }}</b></span> </p> 
                                                                <p class="text-center">Referal Bonus: <span class="item">{{$setting->ref_bonus}}% Referal Bonus</span></p>
                                                                <p class="text-center">ROI Withdrawal Duration: <span class="item">{{$each_plan->intrest_duration}} Days</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-6 col-xl-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row m-b-30">
                                                        <div class="col-md-12">
                                                            <div class="new-arrival-content position-relative">
                                                                <h3 class="text-center text-danger">
                                                                    {{ $each_plan->plan_name }}
                                                                    <br>
                                                                    <input name="plan_unique_id" type="radio" style="height: 20px; width: 20px" value="{{ $each_plan->unique_id }}">
                                                                </h3>
                                                                <p class="text-center">Min Amount : <span class="item"> <b>$ {{ number_format($each_plan->min_amount) }}</b></span></p>
                                                                <p class="text-center">Max Amount : <span class="item"> <b>$ {{ number_format($each_plan->max_amount) }}</b></span></p>
                                                                <p class="text-center">Percentage Interest : <span class="item"> <b>{{ $each_plan->plan_percentage }} (%)</b></span> </p> 
                                                                <p class="text-center">Interest Recieve : <span class="item"> <b>{{ $each_plan->payment_interval }}</b></span> </p> 
                                                                <p class="text-center">Referal Bonus: <span class="item">{{$setting->ref_bonus}}% Referal Bonus</span></p>
                                                                <p class="text-center">ROI Withdrawal Duration: <span class="item">{{$each_plan->intrest_duration}} Days</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Create Payment Invoice</button>
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