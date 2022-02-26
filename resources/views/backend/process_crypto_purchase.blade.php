@php 
$pageTitle = "Crypto Purchase Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process Crypto Purchase</a></li>
					</ol>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                            <form action="{{ route('process-purchase-request', $coinsToPurchase->unique_id) }}" method="POST"> @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center>
                                            <img width="100" height="100" src="{{$coinsToPurchase->coin_logo}}" alt="{{$coinsToPurchase->coin_name}}"/>
                                            <h2 class="fs-24 font-w600 text-black mb-0"> {{strtoupper($coinsToPurchase->coin_name)}}</h2>
                                            <span class="fs-14 font-w600">{{$coinsToPurchase->coin_symbol}}</span>
                                        </center>    
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <hr/>
                                        <h3> <span class="text-danger">Note!</span> <br> 1 {{$coinsToPurchase->coin_symbol}} is equal to ${{ $coinsToPurchase->currrent_price }}  </h3>
                                        <hr/>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="text-center alert alert-warning mt-3">
                                            You are about to purchase <span class="text-success">{{strtoupper($coinsToPurchase->coin_name)}}</span> from {{$setting->site_name}} at the rate of <span class="text-success">${{number_format($coinsToPurchase->currrent_price)}}</span> <br> <b>Note:</b> No service fee will be charged, {{$setting->site_name}} will automatically invest the said amount. <br> For further inqueries, please conatct our 24/7 live support or send an email to <a href="mailto::{{$setting->site_email}}">{{$setting->site_email}}</a>
                                         </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <h3 class="m-0 text-center" style="border: 2px solid grey; padding: 3px; border-radius: 5px; background-color: grey; color: #fff"><span id="calculated_amount">0</span> {{$coinsToPurchase->coin_symbol}}</h3>
                                            <label for="amount">Amount</label>
                                            <input type="number" onkeyup="calculateCoinValue({{$coinsToPurchase->currrent_price}})" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Proceed</button>
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

    <script>
        function calculateCoinValue(value) {
            let dataHold = '';
            let amount = $('#amount').val();
            let new_amount = (amount / value);
            $('#calculated_amount').html(new_amount);
        }
    </script>

</body>

</html>