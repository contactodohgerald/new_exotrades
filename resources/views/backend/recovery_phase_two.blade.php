@php 
$pageTitle = "Transfer Portfolio Page";
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
						<li class="breadcrumb-item"><a href="{{'dashboard'}}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{route('portifolio/transfer')}}">Portfolio Recovery</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Fund Transfer</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div id="about-me" class="tab-pane fade active show">
                                        <div class="profile-personal-info">
                                            <h4 class="text-primary mb-4">Portfolio Details</h4>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Full Name <span class="pull-right">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $user->name == null ? 'None Provided':$user->name }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $user->email == null ? 'None Provided':$user->email }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Account ID <span class="pull-right">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $accountRecovery->account_id == null ? 'None Provided':$accountRecovery->account_id }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Total Deposit <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>USD {{ number_format($accountRecovery->recovery_amount) }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Total Compounding <span class="pull-right">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $accountRecovery->comp_days }} Days</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Total Rollover <span class="pull-right">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $accountRecovery->rollover }} Times</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Portifolio Value <span class="pull-right">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>USD {{ number_format($accountRecovery->portifolio_value) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="text-center">
                                            <h4>Service Charge (2%)</h5>
                                             @php $cal = ($accountRecovery->recovery_amount * 2) / 100; @endphp   
                                            <h1>USD {{number_format($cal)}}</h3>
                                        </div>
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <form action="{{ route('process/service/charge', $accountRecovery->unique_id) }}" method="POST"> @csrf
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" readonly value="{{$cal}}" class="form-control" name="amount" id="amount"/>
                                            </div> 
                                            <div class="form-group">
                                                <label for="system_wallet_id">Select Payment Type</label>
                                                <select class="form-control " id="system_wallet_id" name="system_wallet_id" required>
                                                    @if(count($systemWallet) > 0)
                                                        @foreach($systemWallet as $each_wallet)
                                                            <option value="{{$each_wallet->unique_id }}">{{$each_wallet->wallet_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>  
                                            <button class="btn btn-primary" type="submit">Continue</button>    
                                        </form>
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

</body>

</html>