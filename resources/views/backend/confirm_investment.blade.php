@php 
$pageTitle = "Confrim Investment Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Confirm Investments</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Confirm Investments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Plan</th>
                                                <th class="text-center">Date Invested</th>
                                                <th class="text-center">Payment Proof</th>
                                                <th class="text-center">Payment Option</th>
                                                <th class="text-center">Decline</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($transactions) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($transactions as $each_invest)
                                                <tr>	
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ ($each_invest->users == null)? 'None' : $each_invest->users->email }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->amount) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_invest->received_status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $each_invest->plans->plan_name }}</td>
                                                    <td class="text-center">{{ $each_invest->created_at->diffForHumans() }}</td>										
                                                    <td class="text-center">
                                                        <button class="btn btn-warning" onclick="viewPaymentProof('{{$each_invest->payment_proof }}')">Proof</button>
                                                    </td>	
                                                    @if($each_invest->received_status == 'confirmed')
                                                    <td class="text-center">
                                                        <button class="btn btn-success" onclick="brinOutUncomfrimPaymentModal('{{$each_invest->unique_id }}')">Unconfrim</button>
                                                    </td>
                                                    @else
                                                    <td class="text-center">
                                                        <button class="btn btn-danger" onclick="brinOutComfrimPaymentModal('{{$each_invest->unique_id }}')">Comfrim</button>
                                                    </td>
                                                    @endif 
                                                    <td class="text-center">
                                                        <button class="btn btn-dark" onclick="brinOutDeclinePaymentModal('{{$each_invest->unique_id }}')">Decline</button>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('payment-invoice', $each_invest->unique_id ) }}">Edit Investment</a>
                                                                <a class="dropdown-item" href="javascript:void()" onclick="brinOutDeletePaymentModal('{{$each_invest->unique_id }}')">Delete Payment</a>
                                                            </div>
                                                        </div>
                                                    </td>								
                                                </tr>

                                                @php $counter++ @endphp    
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12" class="text-center">No Data Available at this Moment</td>
                                                </tr>
                                            @endif
                                                                                 
                                        </tbody>                                       
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    {{ $transactions->render("pagination::bootstrap-4") }}                    
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
        <div class="modal fade" id="confirmPayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Users Payment</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to confirm this payment? (This mean you have check your wallet and confirmed that the deposit the user claim to have made is true.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('confirm-payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control transId" id="transId" name="transId">
                                    <button class="btn btn-primary" type="submit">Confirm Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="unconfirmPayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Unconfirm Users Payment</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to Unconfirm this user? (This mean you have mistakely confirmed this user in the past and found that you have not received the payment he claims to have made.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('unconfirm-payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control uncomfirmTransId" id="uncomfirmTransId" name="uncomfirmTransId">
                                    <button class="btn btn-primary" type="submit">Unconfirm Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="paymentProof">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Payment Proof</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12" id="imageHold">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deletePayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Users Payment</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <h4 class="text-center">Are you sure you want to delete this user's Payment?</h4>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('delete-payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteTransId" id="deleteTransId" name="deleteTransId">
                                    <button class="btn btn-primary" type="submit">Delete Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="declinePayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Decline Users Payment</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to decline this payment?</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('decline-payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control uniqueIdToProcess" id="uniqueIdToProcess" name="uniqueIdToProcess">
                                    <button class="btn btn-primary" type="submit">Decline Payment</button>
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
        function brinOutComfrimPaymentModal(trans_id) {
            $("#transId").val(trans_id)
            $('#confirmPayment').modal('show')
        } 
        
        function brinOutDeclinePaymentModal(trans_id) {
            $("#uniqueIdToProcess").val(trans_id)
            $('#declinePayment').modal('show')
        }

        function brinOutUncomfrimPaymentModal(trans_id) {
            $("#uncomfirmTransId").val(trans_id)
            $('#unconfirmPayment').modal('show')
        }

        function viewPaymentProof(file_proof) {
            let dataHold = '';
            let mm = (file_proof == 'default.png') ? 'images/default.png' : file_proof
            dataHold += `<img src="${mm}" alt="No Payment Proof Available" style="height: 100%; width:100%">`
            $("#imageHold").html(dataHold)
            $('#paymentProof').modal('show')
        }

        function brinOutDeletePaymentModal(trans_id) {
            $("#deleteTransId").val(trans_id)
            $('#deletePayment').modal('show')
        }
    </script>

</body>

</html>