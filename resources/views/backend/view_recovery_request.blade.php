@php 
$pageTitle = "Confirm Recovery Request Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Confirm Recovery Request</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Confirm Recovery Request</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Recovery Amount</th>
                                                <th class="text-center">Recovery Proof</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Payment Proof</th>
                                                <th class="text-center">Payment Option</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($accountRecovery) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($accountRecovery as $each_recovery)
                                                <tr>	
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ ($each_recovery->users == null)? 'None' : $each_recovery->users->email }}</td>
                                                    <td class="text-center">USD {{ number_format($each_recovery->recovery_amount) }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-warning shadow btn-xs" onclick="viewRecoveryProof('{{$each_recovery->proof }}')">Proof</button>
                                                    </td>	
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_recovery->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_recovery->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_recovery->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">USD {{ number_format($each_recovery->amount) }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-warning shadow btn-xs" onclick="viewPaymentProof('{{$each_recovery->payment_proof }}')">Proof</button>
                                                    </td>	
                                                    <td class="text-center">{{ $each_recovery->system_wallet->wallet_name }}</td>
                                                    <td class="text-center">{{ $each_recovery->created_at->diffForHumans() }}</td>										
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="javascript:void()" onclick="brinOutComfrimPaymentModal('{{$each_recovery->unique_id }}')">Approve Payment</a>
                                                                <a class="dropdown-item" href="{{ route('make/recovery/payment', $each_recovery->unique_id ) }}">Edit Investment</a>
                                                                <a class="dropdown-item" href="javascript:void()" onclick="brinOutDeletePaymentModal('{{$each_recovery->unique_id }}')">Delete Payment</a>
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
                                    {{ $accountRecovery->render("pagination::bootstrap-4") }}                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recovery Request History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Recovery Amount</th>
                                                <th class="text-center">Recovery Proof</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Payment Proof</th>
                                                <th class="text-center">Payment Option</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($accountRecoveryConfirm) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($accountRecoveryConfirm as $each_recovery)
                                                <tr>	
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ ($each_recovery->users == null)? 'None' : $each_recovery->users->email }}</td>
                                                    <td class="text-center">USD {{ number_format($each_recovery->recovery_amount) }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-warning shadow btn-xs" onclick="viewRecoveryProof('{{$each_recovery->proof }}')">Proof</button>
                                                    </td>	
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_recovery->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_recovery->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_recovery->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">USD {{ number_format($each_recovery->amount) }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-warning shadow btn-xs" onclick="viewPaymentProof('{{$each_recovery->payment_proof }}')">Proof</button>
                                                    </td>	
                                                    <td class="text-center">{{ $each_recovery->system_wallet->wallet_name }}</td>
                                                    <td class="text-center">{{ $each_recovery->created_at->diffForHumans() }}</td>										
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('make/recovery/payment', $each_recovery->unique_id ) }}">Edit Investment</a>
                                                                <a class="dropdown-item" href="javascript:void()" onclick="brinOutDeletePaymentModal('{{$each_recovery->unique_id }}')">Delete Payment</a>
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
                                    {{ $accountRecoveryConfirm->render("pagination::bootstrap-4") }}                    
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
                        <h5 class="modal-title">Approve Payment</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('approve/recovery/request') }}" method="POST"> @csrf
                            <div class="row"> 
                                <div class="col-lg-12">
                                    <p class="text-center">Are you sure you want to confirm this payment? (This mean you have check your wallet and confirmed that the deposit the user claim to have made is true.)</p>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" placeholder="Amount" id="amount" name="amount">
                                        <input type="hidden" class="form-control transId" id="transId" name="transId">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="days">Compoundment Days</label>
                                            <input type="number" class="form-control" placeholder="Compoundment Days" id="days" name="days">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="rollover">Rollover</label>
                                            <input type="number" class="form-control" placeholder="Rollover" id="rollover" name="rollover">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Approve Payment</button>
                                </div>
                            </div>
                        </form>
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
        <div class="modal fade" id="recoveryPaymentProof">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Recovery Proof</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12" id="imageHolds">
                               
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
                        <h5 class="modal-title">Delete Payment</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <h4 class="text-center">Are you sure you want to delete this user's Payment?</h4>
                               
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('delete/recovery/request') }}" method="POST">
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

        function viewPaymentProof(file_proof) {
            let dataHold = '';
            let mm = (file_proof == 'default.png') ? 'images/default.png' : file_proof
            dataHold += `<img src="${mm}" alt="No Payment Proof Available" style="height: 100%; width:100%">`
            $("#imageHold").html(dataHold)
            $('#paymentProof').modal('show')
        }

        function viewRecoveryProof(file_proof) {
            let dataHold = '';
            let mm = (file_proof == 'default.png') ? 'images/default.png' : file_proof
            dataHold += `<img src="${mm}" alt="No Payment Proof Available" style="height: 100%; width:100%">`
            $("#imageHolds").html(dataHold)
            $('#recoveryPaymentProof').modal('show')
        }

        function brinOutDeletePaymentModal(trans_id) {
            $("#deleteTransId").val(trans_id)
            $('#deletePayment').modal('show')
        }
    </script>

</body>

</html>