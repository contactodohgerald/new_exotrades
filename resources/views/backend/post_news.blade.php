@php 
$pageTitle = "Post News Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Post News</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Post News</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <div class="alert alert-success text-center">
                                            <p><b>NOTE:</b> News Post here will automatically be forwarded to all registered members email in this site ensure you handle with all accuracy.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
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
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Email</th>
                                                        <th class="text-center">Account Status</th>
                                                        <th class="text-center">Date Joined</th>
                                                        <th class="text-center">Post News</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($users) > 0)
                                                    @php $counter = 1; @endphp
                                                        @foreach ($users as $each_user)
                                                        <tr>
                                                            <td class="text-center">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" value="{{ $each_user->unique_id }}" name="" class="custom-control-input" id="customCheckBox2" required>
                                                                    <label class="custom-control-label" for="customCheckBox2">{{ $counter }}</label>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">{{ $each_user->name }}</td>
                                                            <td class="text-center">{{ $each_user->email  }}</td>
                                                            <td class="text-center">
                                                                <span class="badge light badge-{{ ($each_user->status == 'active')?'success':'danger' }} ">
                                                                    <i class="fa fa-circle text-{{ ($each_user->status == 'active')?'success':'danger' }}  mr-1"></i>
                                                                    {{ ($each_user->status == 'active')?'Active':'Inactive' }}
                                                                </span>
                                                            </td>	
                                                            <td class="text-center">{{ $each_user->created_at->diffForHumans() }}</td>
                                                            <td class="text-center">
                                                                <button class="btn btn-primary shadow btn-xs sharp mr-1" onclick="brinOutPostNewsModal('{{$each_user->unique_id }}')"><i class="fa fa-money"></i></button>
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
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

         <!-- Modal -->
         <div class="modal fade" id="postNews">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Post News To User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form action="{{ route('post-news-request') }}" method="POST">
                        @csrf
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-lg-12">
                               <div class="form-group">
                                   <label for="news_tile">News Title</label>
                                   <input type="text" class="form-control" name="news_tile" id="news_tile" placeholder="News Title" required>
                               </div>
                               <div class="form-group">
                                    <label for="news_body">News Body</label>
                                    <textarea class="form-control" name="news_body" id="news_body" placeholder="News Body" required></textarea>
                                </div>
                            </div>
                            <input type="hidden" class="form-control userId" id="userId" name="userId">
                            <div class="col-lg-12 mt-2">
                                 <button class="btn btn-primary" type="submit">Post</button>
                            </div>
                        </div>
                    </div>
                </form>
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
        function brinOutPostNewsModal(user_id) {
            $("#userId").val(user_id)
            $('#postNews').modal('show')
        }
    </script>

</body>

</html>