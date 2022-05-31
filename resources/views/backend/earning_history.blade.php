@php 
$pageTitle = "Earnings History Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View Earnings History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">View Earnings History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Plan Name</th>
                                                <th class="text-center">Amount ($)</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($earnings) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($earnings as $each_earning)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_earning->transactions->plans->plan_name }}</td>
                                                    <td class="text-center">{{ number_format($each_earning->amount) }}</td>
                                                    @if($each_earning->earning_type == 'interest_payout')
                                                        @php $type = 'Interest Payout' @endphp
                                                    @elseif($each_earning->earning_type == 'interest_earning')
                                                        @php $type = 'Interest Earning' @endphp
                                                    @else
                                                        @php $type = 'Capital Payout' @endphp
                                                    @endif
                                                    <td class="text-center">{{ $type }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_earning->status == 'pending')?'warning':'success' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_earning->status == 'pending')?'warning':'success' }}  mr-1"></i>
                                                            {{ $each_earning->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $each_earning->created_at->diffForHumans() }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-danger" onclick="brinOutDeleteReinvestModal('{{$each_earning->unique_id }}')">Delete</button>
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
                                    {{ $earnings->render("pagination::bootstrap-4") }}                            
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
        <div class="modal fade" id="deleteReinvestModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reinvest Earning </h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12 text-center">
                               <p>Are you really sure you want to delete this transation?</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('delete-earning-reinvest') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteTransId" id="deleteTransId" name="deleteTransId">
                                    <button class="btn btn-primary" type="submit">Proceed</button>
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
        function brinOutDeleteReinvestModal(trans_id) {
            $("#deleteTransId").val(trans_id)
            $('#deleteReinvestModal').modal('show')
        }
    </script>

</body>

</html>