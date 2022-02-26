@php 
$pageTitle = "Upgrade Investment";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Upgrade Investment</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Upgrade Investment</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Investment Upgrade</th>
                                                <th class="text-center">Plan</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Interest Growth ($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Day Counter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($invest) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($invest as $each_invest)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary" onclick="brinOutUpgradeModal('{{$each_invest->unique_id }}')">Upgrade</button>
                                                    </td>	
                                                    <td class="text-center">{{ $each_invest->plans->plan_name }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->amount) }}</td>
                                                    <td class="text-center">{{ number_format($each_invest->intrest_growth) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->received_status == 'pending')?'warning':'success' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->received_status == 'pending')?'warning':'success' }}  mr-1"></i>
                                                            {{$each_invest->received_status }}
                                                        </span>
                                                    </td>	
                                                    <td class="text-center">{{ $each_invest->day_counter }}</td>		
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

        <!-- Modal -->
        <div class="modal fade" id="planUpgrade">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upgrade Plan</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">You are about upgrading you current investment plan, <br> <b>Note!</b> your investment duration won't be affected by this. You interest rate will change based on the amount are adding.</p>
                            </div>
                            <div class="col-lg-12 mt-2" id="urlId">
                               
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
        function brinOutUpgradeModal(invest_id) {
            let dataHold = '';
            dataHold += `<a href="plan_upgrade/${invest_id}" class="btn btn-primary" type="submit">Procced</a>`
            $("#urlId").html(dataHold)
            $('#planUpgrade').modal('show')
        }
    </script>

</body>

</html>