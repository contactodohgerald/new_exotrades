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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Interest</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Interest</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
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
                                                <th class="text-center">Add Interest</th>
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
                                                    <td class="text-center">{{ $each_invest->day_counter }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_invest->received_status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_invest->received_status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $each_invest->plans->plan_name }}</td>
                                                    <td class="text-center">
                                                        <a href="javascript:void()" class="btn btn-primary shadow btn-xs sharp mr-1" onclick="brinOutAddInterestrModal('{{$each_invest->unique_id }}', '{{$each_invest->intrest_growth }}', '{{$each_invest->day_counter }}')"><i class="fa fa-pencil"></i></a>					
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
        <div class="modal fade" id="addInterest">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Deposite Interest</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                               <form action="{{ route('add-interest') }}" method="POST">
                                   @csrf
                                   <div class="form-group">
                                       <label for="intrest">Interest</label>
                                       <input type="number" class="form-control" id="intrest" name="intrest" required>
                                   </div>
                                   <div class="form-group">
                                        <label for="day_counter">Day Counter</label>
                                        <input type="number" class="form-control" id="day_counter" name="day_counter" required>
                                    </div>
                                    <input type="hidden" class="form-control investId" id="investId" name="investId">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add Interest</button>
                                    </div>
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
        function brinOutAddInterestrModal(invest_id, amount, day_counter) {
            $("#intrest").val(amount)
            $("#day_counter").val(day_counter)
            $("#investId").val(invest_id)
            $('#addInterest').modal('show')
        }
    </script>


</body>

</html>