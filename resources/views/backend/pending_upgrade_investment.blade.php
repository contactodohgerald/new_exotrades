@php 
$pageTitle = "Pending Upgraded Investment Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Pending Upgraded Investment History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pending Upgraded Investment History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Upgraded Amount($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Wallet Type</th>
                                                <th class="text-center">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($pendingInvests) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($pendingInvests as $each_transaction)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ number_format($each_transaction->amount) }}</td>
                                                    <td class="text-center">{{ number_format($each_transaction->amount_upgrade) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_transaction->received_status == 'pending')?'danger':'success' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_transaction->received_status == 'pending')?'danger':'success' }}  mr-1"></i>
                                                            {{ $each_transaction->received_status }}
                                                        </span>
                                                    </td>	
                                                    <td class="text-center">{{ $each_transaction->system_wallet->wallet_name }} Wallet</td>
                                                    <td class="text-center">{{ $each_transaction->created_at->diffForHumans() }}</td>	
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
                                    {{ $pendingInvests->render("pagination::bootstrap-4") }}                         
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