@php 
$pageTitle = "Purchase Payout Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Purchase Payout</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Purchase Payout</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Coin Bought</th>
                                                <th class="text-center">Amount ($)</th>
                                                <th class="text-center">Amount To Pay ($)</th>
                                                <th class="text-center">Day Counter</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Payout Action</th>
                                                <th class="text-center">Date Invested</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($cryptoPurchase) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($cryptoPurchase as $each_invest)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_invest->users->email }}</td>
                                                    <td class="text-center">
                                                        <div class="font-w600 d-flex align-items-center">
                                                            <img width="25" height="25" src="{{$each_invest->coin_details->coin_logo}}" alt="{{$each_invest->coin_details->coin_name}}"/>
                                                            {{$each_invest->coin_details->coin_name}}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ number_format($each_invest->amount_to_buy) }}</td>
                                                    <td class="text-center">{{number_format($each_invest->amount_to_pay)}}</td>
                                                    <td class="text-center">{{$each_invest->day_counter}}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->status == 'completed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->status == 'completed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_invest->status }}
                                                        </span>
                                                    </td>
                                                    @if($each_invest->settled_status == 'yes')
                                                    <td class="text-center">
                                                        <button class="btn btn-warning">Paid</button>
                                                    </td>
                                                    @else
                                                    <td class="text-center">
                                                        <button class="btn btn-primary" onclick="brinOutCryptoPurchasePayoutModal('{{$each_invest->unique_id }}', '{{$each_invest->amount_to_pay}}')">Pay</button>
                                                    </td>
                                                    @endif
                                                    <td class="text-center">{{ $each_invest->created_at->diffForHumans() }}</td>	
                                                </tr> 

                                                @php $counter++ @endphp    
                                                @endforeach
                                            @else
                                                <tr><td colspan="12" class="text-center">No Data Available at this Moment</td></tr>
                                            @endif
                                                                                 
                                        </tbody>                                       
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    {{ $cryptoPurchase->render("pagination::bootstrap-4") }}                            
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
        <div class="modal fade" id="makePayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crypto Purchase Payout</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12" id="holdValue">
                               
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('payout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control transId" id="transId" name="transId">
                                    <button class="btn btn-primary" type="submit">Proceed</button>
                                </form>
                            </div>
                        </div>
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
        function brinOutCryptoPurchasePayoutModal(trans_id, amount) {
            let dataHold = '';
            dataHold += `<p class="text-center">Are you sure you want to procced with this request? <br> (This means that the total of $${amount} will be added to this user's main balance  )</p>`
            $("#holdValue").html(dataHold)
            $("#transId").val(trans_id)
            $('#makePayment').modal('show')
        }
    </script>

</body>

</html>