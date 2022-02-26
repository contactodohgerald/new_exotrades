@php 
$pageTitle = "Users Account Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Users Account</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Users Account</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">View User Account</th>
                                                <th class="text-center">Account Status</th>
                                                <th class="text-center">Date Joined</th>
                                                <th class="text-center">Account Action</th>
                                                <th class="text-center">Activate User</th>
                                                <th class="text-center">Delete User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($users) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($users as $each_user)
                                                    <tr>
                                                        <td class="text-center">{{ $counter }}</td>
                                                        <td class="text-center">{{ $each_user->email  }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('view-user-profile', $each_user->unique_id ) }}" class="btn btn-info">View</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge light badge-{{ ($each_user->status == 'active')?'success':'danger' }} ">
                                                                <i class="fa fa-circle text-{{ ($each_user->status == 'active')?'success':'danger' }}  mr-1"></i>
                                                                {{ ($each_user->status == 'active')?'Active':'Inactive' }}
                                                            </span>
                                                        </td>	
                                                        <td class="text-center">{{ $each_user->created_at->diffForHumans() }}</td>
                                                        @if($each_user->status == 'active')
                                                        <td class="text-center">
                                                            <button class="btn btn-danger" onclick="brinOutBlockUserModal('{{$each_user->unique_id }}')">Block</button>
                                                        </td>
                                                        @else
                                                        <td class="text-center"> 
                                                            <button class="btn btn-success" onclick="brinOutUnblockUserModal('{{$each_user->unique_id }}')">Un-Block</button>
                                                        </td>
                                                        @endif
                                                        <td class="text-center">
                                                            <button class="btn btn-dark" onclick="brinOutActivateUserModal('{{$each_user->unique_id }}')" {{($each_user->email_verified_at == null)? '' : 'disabled'}}>Activate</button>
                                                        </td>	
                                                        <td class="text-center">
                                                            <button class="btn btn-primary" onclick="brinOutDeleteUserModal('{{$each_user->unique_id }}')">Delete</button>
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
                                    {{ $users->render("pagination::bootstrap-4") }}                           
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
          <div class="modal fade" id="blockUser">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Block User Account</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to block this user? <br/> (This mean the user will not be able to log in to their account.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('block-user-account') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control userId" id="userId" name="userId">
                                    <button class="btn btn-primary" type="submit">Block User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <!-- Modal -->
        <div class="modal fade" id="unblockUser">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Unblock User Account</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to unblock this user? <br/> (This means that this  user will now have the ability to log in to their account.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('unblock-user-account') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control unBlockUserId" id="unBlockUserId" name="unBlockUserId">
                                    <button class="btn btn-primary" type="submit">Unblock User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="activateUser">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Activate User Account</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to activate this user? <br/> (This means that this  user will now have the ability to log in to their account.)</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('activate-user-account') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control activateUserId" id="activateUserId" name="activateUserId">
                                    <button class="btn btn-primary" type="submit">Activate User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteUser">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User Account</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                                <p class="text-center">Are you sure you want to delete this user?</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <form action="{{ route('delete-user-account') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control deleteUserId" id="deleteUserId" name="deleteUserId">
                                    <button class="btn btn-primary" type="submit">Delete User</button>
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
        function brinOutBlockUserModal(user_id) {
            $("#userId").val(user_id)
            $('#blockUser').modal('show')
        }

        function brinOutUnblockUserModal(user_id) {
            $("#unBlockUserId").val(user_id)
            $('#unblockUser').modal('show')
        }
        
        function brinOutActivateUserModal(user_id) {
            $("#activateUserId").val(user_id)
            $('#activateUser').modal('show')
        }

        function brinOutDeleteUserModal(user_id) {
            $("#deleteUserId").val(user_id)
            $('#deleteUser').modal('show')
        }
    </script>

</body>

</html>