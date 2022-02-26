@php 
$pageTitle = "Coin Swap History Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Coin Swap History</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Coin Swap History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Swaped From</th>
                                                <th class="text-center">Swaped To</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Date Performed</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($coinSwap) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($coinSwap as $each_coin_swap)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ number_format($each_coin_swap->amount) }}</td>
                                                    <td class="text-center">{{ $each_coin_swap->from_coin }}</td>
                                                    <td class="text-center">{{ $each_coin_swap->to_coin }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_coin_swap->status == 'success')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_coin_swap->status == 'success')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_coin_swap->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $each_coin_swap->created_at->diffForHumans() }}</td>
                                                    <td class="text-center">
                                                        <div class="dropdown ml-auto ">
                                                            <div class="btn-link" data-toggle="dropdown">
                                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="javascript:void()" data-toggle="modal" data-target="#deleteTrans{{  $each_coin_swap->unique_id }}">Delete Transaction</a>
                                                            </div>
                                                        </div>
                                                    </td>												
                                                </tr> 
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="deleteTrans{{ $each_coin_swap->unique_id }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Transaction</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row"> 
                                                                    <div class="col-lg-12">
                                                                        <h4 class="text-center">Are you sure you want to delete this trnsaction?</h4>
                                                                    </div>
                                                                    <div class="col-lg-12 mt-2"> 
                                                                        <form action="{{ route('delete-swap', $each_coin_swap->unique_id) }}" method="POST">
                                                                            @csrf
                                                                            <button class="btn btn-primary" type="submit">Delete Transaction</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $counter++ @endphp    
                                                @endforeach
                                            @else
                                                <tr><td colspan="11" class="text-center">No Data Available at this Moment</td></tr>
                                            @endif
                                                                                 
                                        </tbody>                                       
                                    </table>
                                </div>
                                <div class="card-footer text-right">   
                                    {{ $coinSwap->render("pagination::bootstrap-4") }}                         
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