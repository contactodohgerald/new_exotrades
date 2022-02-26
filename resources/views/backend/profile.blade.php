@php 
$pageTitle = "Profile Page";
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View Profile</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo" style="padding-top: 20px" >
                                        <center>
                                            <div style="width: 200px; height: 200px; border-radius: 50%; border: 3px solid grey;">
                                                <img src="{{($user->avatar == 'avatar.png') ? 'images/avatar.png' : $user->avatar}}" alt="{{$user->name}}" width="100%" height="100%" />
                                            </div>
                                        </center>
                                    </div>
                                </div>
                                <div class="profile-info">
									<div class="profile-details">
										<div class="profile-name px-3 pt-2">
                                            <p class="text-center">Referral Link</p>
											<h4 class="text-primary mb-0">{{ url('/') }}?ref={{ $user->referral_id }}</h4>
                                            <input style="display: none" type="text" value="{{ url('/') }}?ref={{ $user->referral_id }}" class="form-control" id="copyWallet">
                                            <button class="btn btn-dark" onclick="processWalletCopy()">Copy & Paste Link</button>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs" style="margin-bottom: 1em">
                                            <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">Profile</a>
                                            </li>
                                            <li class="nav-item"><a href="#wallet" data-toggle="tab" class="nav-link">Wallet</a>
                                            </li>
                                            <li class="nav-item"><a href="#account-information" data-toggle="tab" class="nav-link">Account</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="about-me" class="tab-pane fade active show">
                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Personal Information</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">FullName <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->email }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Account Type <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->account_type }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Phone Number <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->phone == null ? 'None Provided':$user->phone }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->gender == null ? 'None Provided':$user->gender }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->address == null ? 'None Provided':$user->address }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="wallet" class="tab-pane fade">
                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Wallet Information</h4>
                                                    <div class="row mb-2">
                                                        @if(count($userWallet) > 0)
                                                            @foreach($userWallet as $each_wallet)
                                                                <div class="col-sm-3 col-5">
                                                                    <h5 class="f-w-500">{{$each_wallet->system_wallet->wallet_name}}<span class="pull-right">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-sm-9 col-7"><span>{{ $each_wallet->wallet_address }}</span>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="col-sm-12 col-lg-12 text-center alert alert-success">
                                                                <p>You haven't set up any wallet address, kindly navigate to your settings page to do so</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="account-information" class="tab-pane fade">
                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Account Information</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Account Number<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span>{{ $user->account_number == null ? 'None Provided':$user->account_number }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
	
	<!--removeIf(production)-->
        
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('includes.e_script')

    <script>
        function processWalletCopy() {
            /* Get the text field */
            var copyText = document.getElementById("copyWallet");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Link Copied! " + copyText.value);
        }
    </script>
		
</body>

</html>