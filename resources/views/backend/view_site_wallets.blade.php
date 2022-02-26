@php 
$pageTitle = "View Site Wallet Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View Site Wallet</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">View Site Wallet</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Wallet Name</th>
                                                <th class="text-center">Wallet Address</th>
                                                <th class="text-center">Admin Status</th>
                                                <th class="text-center">Delete Wallet</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($walletAddress) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($walletAddress as $each_wallet)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_wallet->wallet_name }}</td>
                                                    <td class="text-center">{{ $each_wallet->wallet_address }}</td>
                                                    <td class="text-center">{{ $each_wallet->admin_only }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-danger" onclick="brinOutDeleteWalletModal('{{$each_wallet->unique_id }}')">Delete</button>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('edit-site-wallet', $each_wallet->unique_id ) }}">Edit Address</a>
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

        <!-- Modal -->
        <div class="modal fade" id="deleteWallet">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Site Wallet</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to delete this wallet?</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('delete-site-wallet') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteWalletId" id="deleteWalletId" name="deleteWalletId">
                                    <button class="btn btn-primary" type="submit">Delete Wallet</button>
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
        function brinOutDeleteWalletModal(unique_id) {
            $("#deleteWalletId").val(unique_id)
            $('#deleteWallet').modal('show')
        }
    </script>

</body>

</html>