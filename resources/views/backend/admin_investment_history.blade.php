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
                                    <table id="" class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="checkAll" required="">
														<label class="custom-control-label" for="checkAll">S/N</label>
													</div>
												</th>
                                                <th class="text-center">User Email</th>
                                                <th class="text-center">Deposit Amount($)</th>
                                                <th class="text-center">Interest ($)</th>
                                                <th class="text-center">Day Counter</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Plan</th>
                                                <th class="text-center">Date Invested</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($invest) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($invest as $each_invest)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheckBox2" required="">
                                                            <label class="custom-control-label" for="customCheckBox2">{{ $counter }}</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ ($each_invest->users == null)? 'None' : $each_invest->users->email }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->amount) }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->intrest_growth) }}</td>
                                                    <td class="text-center">{{$each_invest->day_counter}}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_invest->received_status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $each_invest->plans->plan_name }}</td>
                                                    <td class="text-center">{{ $each_invest->created_at->diffForHumans() }}</td>										
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