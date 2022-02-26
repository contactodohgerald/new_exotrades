@php 
$pageTitle = "Add Site Wallet";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Site Wallet</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-b-30">
                                    <div class="col-lg-6 offset-lg-3">
                                        <h3 class="text-primary text-center m-2">Add Site Wallet</h3>
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <form action="{{ route('add-site-wallet') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <label>Wallet Name <small class="text-danger">*</small></label>
                                                    <input type="text" placeholder="Wallet Name" class="form-control" name="wallet_name" required/>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Wallet Address <small class="text-danger">*</small></label>
                                                    <input type="text" placeholder="Wallet Address" class="form-control" name="wallet_address" required/>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Admin Only <small class="text-danger">*</small></label>
                                                    <select class="form-control" name="admin_only" required>
                                                        <option value="no">No</option>
                                                        <option value="yes">Yes</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Wallet Image</label>
                                                    <input type="file" class="form-control" name="thumbnail"/>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Current Value</label>
                                                    <input type="number" placeholder="Wallet Address" class="form-control" name="current_value"/>
                                                </div>
                                            </div>
                                                                                 
                                            <button class="btn btn-primary" type="submit">Add New Wallet</button>
                                        </form>
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