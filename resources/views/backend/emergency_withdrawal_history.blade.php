@php 
$pageTitle = "Emergency Withdrawal History Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Emergency Withdrawal History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Emergency Withdrawal History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Wallet Type</th>
                                                <th class="text-center">Wallet Address</th>
                                                <th class="text-center">Settlement Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($withdraw) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($withdraw as $each_withdraw)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ number_format($each_withdraw->amount) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_withdraw->status }}
                                                        </span>
                                                    </td>	
                                                    <td class="text-center">{{ $each_withdraw->user_wallet->system_wallet->wallet_name }}</td>	
                                                    <td class="text-center">{{ $each_withdraw->user_wallet->wallet_address }}</td>	
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->remove_status == 'yes')?'success':'warning' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->remove_status == 'yes')?'success':'warning' }}  mr-1"></i>
                                                            {{ ($each_withdraw->remove_status == 'yes')?'Settled':'Processing' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary" onclick="brinOutDeleteWithdrwalModal('{{$each_withdraw->unique_id }}')">Delete</button>
                                                    </td>												
                                                </tr> 
                                                @php $counter++ @endphp    
                                                @endforeach
                                            @else
                                                <tr><td colspan="11" class="text-center">No Data Available at this Moment</td></tr>
                                            @endif
                                                                                 
                                        </tbody>                                       
                                    </table>
                                </div>
                                <div class="card-footer text-right">  
                                    {{ $withdraw->render("pagination::bootstrap-4") }}                        
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
        <div class="modal fade" id="deleteWithdrawal">
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
                                <form action="{{ route('delete-emergency-withdraw') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteWithdrawId" id="deleteWithdrawId" name="deleteWithdrawId">
                                    <button class="btn btn-primary" type="submit">Delete Transaction</button>
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
        function brinOutDeleteWithdrwalModal(unique_id) {
            $("#deleteWithdrawId").val(unique_id)
            $('#deleteWithdrawal').modal('show')
        }
    </script>

</body>

</html>