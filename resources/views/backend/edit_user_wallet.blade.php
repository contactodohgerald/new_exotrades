@php 
$pageTitle = "Edit User Wallet";
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">View User Wallet</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit User Wallet</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-b-30">
                                    <div class="col-lg-6 offset-lg-3">
                                        <h3 class="text-primary text-center m-2">Edit User Wallet</h3>
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                        <form action="{{ route('update-user-wallet', $walletAddress->unique_id) }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <label>Wallet Type</label>
                                                    <select class="form-control" name="wallet_addresse_id" required>
                                                        <option value="">Please Select</option>
                                                        @if(count($systemWallet) > 0)
                                                            @foreach($systemWallet as $each_wallet)
                                                                <option {{($walletAddress->wallet_addresse_id == $each_wallet->unique_id)? 'selected' : ''}} value="{{$each_wallet->unique_id}}">{{$each_wallet->wallet_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Wallet Address</label>
                                                    <input type="text" placeholder="Wallet Address" class="form-control" name="wallet_address" value="{{$walletAddress->wallet_address}}" required>
                                                </div>
                                            </div>
                                                                                 
                                            <button class="btn btn-primary" type="submit">Update User Wallet</button>
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