@php 
$pageTitle = "Payment History Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Payment History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Payment History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table  ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Action Performed</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Amount Paid($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Wallet Type</th>
                                                <th class="text-center">Settlement Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($withdraw) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($withdraw as $each_withdraw)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_withdraw->users->email }}</td>
                                                    <td class="text-center">
                                                        <div class="media">
                                                            <span class="bgl-primary p-3 mr-3">
                                                                <svg width="27" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.9375 6.23199L5.9375 24.875C5.9375 25.6689 6.58107 26.3125 7.375 26.3125C8.16892 26.3125 8.8125 25.6689 8.8125 24.875L8.8125 6.23202L11.2311 8.66232L11.2311 8.66234C11.7911 9.22504 12.7013 9.2272 13.264 8.66717C13.8269 8.10701 13.8288 7.19681 13.2689 6.63421L12.9145 6.9869L13.2689 6.6342L8.3939 1.73558L8.38872 1.73037L8.38704 1.72878C7.82626 1.1728 6.92186 1.17468 6.36301 1.72877L6.36136 1.73033L6.35609 1.73563L1.48109 6.63425L1.48108 6.63426C0.921124 7.19695 0.9232 8.10709 1.48597 8.6672C2.04868 9.22725 2.95884 9.22509 3.51889 8.66238L3.51891 8.66236L5.9375 6.23199Z" fill="#6418C3" stroke="#6418C3"></path>
                                                                </svg>
                                                            </span>
                                                            <div class="media-body align-self-center">
                                                                <h5 class="font-w600 text-black">Withdraw</h5>
                                                                <p class="mb-0 fs-15">{{ $each_withdraw->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ number_format($each_withdraw->amount) }}</td>
                                                    <td class="text-center">{{ number_format($each_withdraw->calculated_amount) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_withdraw->status }}
                                                        </span>
                                                    </td>	
                                                    <td class="text-center">{{ $each_withdraw->wallet_type }}</td>	
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->remove_status == 'yes')?'success':'warning' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->remove_status == 'yes')?'success':'warning' }}  mr-1"></i>
                                                            {{ ($each_withdraw->remove_status == 'yes')?'Settled':'Processing' }}
                                                        </span>
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
                                    {{ $withdraw->links() }}                        
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