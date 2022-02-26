@php 
$pageTitle = "View Plan Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View Plans</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Plans</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Plan Name</th>
                                                <th class="text-center">Percentage(%)</th>
                                                <th class="text-center">Min Amount($)</th>
                                                <th class="text-center">Max Amount($)</th>
                                                <th class="text-center">Payement Interval</th>
                                                <th class="text-center">Intrest Duration(Days)</th>
                                                <th class="text-center">Capital Duration(Days)</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($plan) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($plan as $each_plan)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_plan->plan_name }}</td>
                                                    <td class="text-center">{{ $each_plan->plan_percentage }}</td>
                                                    <td class="text-center">{{ number_format($each_plan->min_amount) }}</td>
                                                    <td class="text-center">{{ ($each_plan->plan_name = 'CONTRACT')?$each_plan->max_amount : number_format($each_plan->max_amount) }}</td>
                                                    <td class="text-center">{{ $each_plan->payment_interval }}</td>
                                                    <td class="text-center">{{ $each_plan->intrest_duration }}</td>
                                                    <td class="text-center">{{ $each_plan->capital_duration }}</td>
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('edit-plan', $each_plan->unique_id ) }}">Edit Plan</a>
                                                            </div>
                                                        </div>
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