@php 
$pageTitle = "Confrim Crypto Purchase Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Confrim Crypto Purchase</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Confrim Crypto Purchase</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-stripped display min-w850">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Coin Bought</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Proof</th>
                                                <th class="text-center">Payment Option</th>
                                                <th class="text-center">Decline</th>
                                                <th class="text-center">Action</th>
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
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_invest->received_status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ number_format($each_invest->amount_to_buy) }}</td>
                                                    <td class="text-center">{{ $each_invest->created_at->diffForHumans() }}</td>										
                                                    <td class="text-center">
                                                        <button class="btn btn-warning" onclick="viewCryptoPurchaseProof('{{$each_invest->payment_proof }}')">Proof</button>
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
                                                                <a class="dropdown-item" href="{{ route('comfirm-purchase', $each_invest->unique_id ) }}">Edit Transaction</a>
                                                                <a class="dropdown-item" href="javascript:void()"  onclick="brinOutDeleteTransaction('{{$each_invest->unique_id }}')">Delete Transaction</a>
                                                            </div>
                                                        </div>
                                                    </td>								
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
         <div class="modal fade" id="paymentProof">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Payment Proof</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12" id="cyrptoPurchaseImageHold">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmCyrptoPurchasePayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Purchase Request</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to confirm this payment? (This mean you have check your wallet and confirmed that the deposit the user claim to have made is true.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('admin-confirm-purchase') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control transId" id="transId" name="transId">
                                    <button class="btn btn-primary" type="submit">Confirm Request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal -->
         <div class="modal fade" id="unconfirmCyrptoPurchasePayment">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Unconfirm Purchase Request</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to Unconfirm this user? (This mean you have mistakely confirmed this user in the past and found that you have not received the payment he claims to have made.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('admin-unconfirm-purchase') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control uncomfirmTransId" id="uncomfirmTransId" name="uncomfirmTransId">
                                    <button class="btn btn-primary" type="submit">Unconfirm Request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteTransaction">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to delete this transaction?</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('delete-purchase') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteTransactionId" id="deleteTransactionId" name="deleteTransactionId">
                                    <button class="btn btn-primary" type="submit">Delete Transaction</button>
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
                                <form action="{{ route('decline-purchase') }}" method="POST">
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
            $('#confirmCyrptoPurchasePayment').modal('show')
        }

        function brinOutDeclinePaymentModal(trans_id) {
            $("#uniqueIdToProcess").val(trans_id)
            $('#declinePayment').modal('show')
        }

        function brinOutUncomfrimPaymentModal(trans_id) {
            $("#uncomfirmTransId").val(trans_id)
            $('#unconfirmCyrptoPurchasePayment').modal('show')
        }

        function viewCryptoPurchaseProof(file_proof) {
            let dataHold = '';
            let mm = (file_proof == 'default.png') ? 'images/default.png' : file_proof
            dataHold += `<img src="${mm}" alt="No Payment Proof Available" style="height: 100%; width:100%">`
            $("#cyrptoPurchaseImageHold").html(dataHold)
            $('#paymentProof').modal('show')
        }

        function brinOutDeleteTransaction(unique_id) {
            $("#deleteTransactionId").val(unique_id)
            $('#deleteTransaction').modal('show')
        }
    </script>

</body>

</html>