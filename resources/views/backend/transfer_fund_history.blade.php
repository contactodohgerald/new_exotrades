@php 
$pageTitle = "Tranfer Funds History Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Tranfer Funds History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tranfer Funds History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Naration</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($transferFund) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($transferFund as $each_transfer)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ number_format($each_transfer->amount) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_transfer->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_transfer->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_transfer->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{$each_transfer->naration}}</td>	
                                                    <td class="text-center">
                                                        <button class="btn btn-danger" onclick="brinOutDeleteTransferModal('{{$each_transfer->unique_id }}')">Delete</button>
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
                                    {{ $transferFund->render("pagination::bootstrap-4") }}                        
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
        <div class="modal fade" id="deleteTransaction">
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
                                <form action="{{ route('delete-funds') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteTransactionId" id="deleteTransactionId" name="deleteTransactionId">
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
        function brinOutDeleteTransferModal(unique_id) {
            $("#deleteTransactionId").val(unique_id)
            $('#deleteTransaction').modal('show')
        }
    </script>

</body>

</html>