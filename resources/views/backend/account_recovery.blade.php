@php 
$pageTitle = "Account Recovery Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Account Recovery</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-b-30">
                                    <div class="col-lg-8 offset-lg-2">
                                        <h3 class="text-primary text-center m-2">Account Recovery</h3>
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <form action="{{ route('account/recovery') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Recovery Code</label>
                                                <input type="text" readonly value="{{$reCode}}" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" placeholder="Email" class="form-control" name="email" id="email" />
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label for="first_date">Date Of First Deposit</label>
                                                    <input type="date" class="form-control" name="first_date" id="first_date" />
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="last_date">Date Of Last Deposit</label>
                                                    <input type="date" class="form-control" name="last_date" id="last_date" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" placeholder="Amount" class="form-control" name="amount" id="amount"/>
                                                </div> 
                                                <div class="form-group col-lg-6">
                                                    <label>Payment Proof</label>
                                                    <input type="file" class="form-control" name="thumbnail">
                                                </div> 
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
                                            <p class="alert alert-warning"> <b>NOTE!</b> <br> The details being requested above is to ensure that the  funds in the so-aclaimed portifolio is retrieved and transfered to the rightful owner.  </p>                    
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