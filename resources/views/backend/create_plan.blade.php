@php 
$pageTitle = "Create Plan Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Create Plan</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-b-30">
                                    <div class="col-lg-8 offset-lg-2">
                                        <h3 class="text-primary text-center m-2">Create New Plan</h3>
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <form action="{{ route('add-plan') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label>Plan Name <small class="text-danger">*</small></label>
                                                    <input type="text" placeholder="Plan Name" class="form-control" name="plan_name" required/>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Plan Percentage <small class="text-danger">*</small></label>
                                                    <input type="text" placeholder="Plan Percentage (E.g 1.5)" class="form-control" name="plan_percentage" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label>Min Plan Amount <small class="text-danger">*</small></label>
                                                    <input type="number" placeholder="Min Amount" class="form-control" name="min_amount" required>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Max Plan Amount <small class="text-danger">*</small></label>
                                                    <input type="text" placeholder="Max Amount" class="form-control" name="max_amount" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label>Intrest Duration</label>
                                                    <input type="number" placeholder="Intrest Duration" class="form-control" name="intrest_duration" />
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Capital Duration</label>
                                                    <input type="number" placeholder="Capital Duration" class="form-control" name="capital_duration" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label>Payment Interval</label>
                                                    <input type="text" placeholder="Payment Interval (E.g Daily, Weekly)" class="form-control" name="payment_interval">
                                                </div>  
                                                <div class="form-group col-lg-6">
                                                    <label>Plan Image</label>
                                                    <input type="file" class="form-control" name="thumbnail">
                                                </div>
                                            </div>
                                                                                 
                                            <button class="btn btn-primary" type="submit">Add New Plan</button>
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