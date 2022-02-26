@php 
$pageTitle = "Emergency Withdrawal Payout Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Emergency Withdrawal Payout</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Emergency Withdrawal Payout</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Actual Amount($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Wallet Type</th>
                                                <th class="text-center">Settlement Status</th>
                                                <th class="text-center">Make Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($withdraw) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($withdraw as $each_withdraw)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_withdraw->users->email }}</td>
                                                    <td class="text-center">{{ number_format($each_withdraw->amount) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_withdraw->status }}
                                                        </span>
                                                    </td>	
                                                    <td class="text-center">{{$each_withdraw->user_wallet->system_wallet->wallet_name}} Wallet</td>	
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->remove_status == 'yes')?'success':'warning' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->remove_status == 'yes')?'success':'warning' }}  mr-1"></i>
                                                            {{ ($each_withdraw->remove_status == 'yes')?'Settled':'Processing' }}
                                                        </span>
                                                    </td>	
                                                    <td class="text-center">
                                                        <a href="{{ route('upgrade-pay-out-processor', $each_withdraw->unique_id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-money"></i></a>					
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