@php 
$pageTitle = "Investment History Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Investment History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Investment History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped display min-w850">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Plan</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Interest Growth($)</th>
                                                <th class="text-center">Day Counter</th>
                                                <th class="text-center">Wallet Type</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($invest) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($invest as $each_invest)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_invest->plans->plan_name }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->amount) }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->intrest_growth) }}</td>
                                                    <td class="text-center">{{ $each_invest->day_counter }}</td>
                                                    <td class="text-center">{{ $each_invest->system_wallet->wallet_name }} Wallet</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_invest->received_status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('payment-invoice', $each_invest->unique_id ) }}">Edit Investment</a>
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
                                    {{ $invest->render("pagination::bootstrap-4") }}                      
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