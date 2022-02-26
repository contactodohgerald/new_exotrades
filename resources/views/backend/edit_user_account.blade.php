@php 
$pageTitle = "Edit User Profile Page";
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Users Account</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit User Profile</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link active show">Basic Setting</a>
                                            </li>
                                            <li class="nav-item"><a href="#account-settings" data-toggle="tab" class="nav-link">Account Setting</a>
                                            </li>
                                            <li class="nav-item"><a href="#security-settings" data-toggle="tab" class="nav-link">Security Setting</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                           
                                            <div id="profile-settings" class="tab-pane fade active show">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Basic Setting</h4>
                                                        <form method="POST" action="{{ route('update-profile', $user->unique_id) }}">
                                                            @csrf

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>FullName</label>
                                                                    <input type="text" placeholder="FullName" class="form-control" name="name" value="{{ $user->name }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Email</label>
                                                                    <input type="email" value="{{ $user->email }}" disabled class="form-control">
                                                                </div>
                                                            </div>
                                                             <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="gender">Gender</label>
                                                                    <select class="form-control " id="gender" name="gender">
                                                                        <option selected="">Please Select...</option>
                                                                        <option {{ ($user->gender === 'Male')?'selected':'' }} value="Male">Male</option>
                                                                        <option {{ ($user->gender === 'Female')?'selected':'' }} value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="country">Country</label>
                                                                    <select class="form-control " id="country" name="country">
                                                                        <option selected="">Please Select...</option>
                                                                        @if (count($country) > 0)
                                                                            @foreach ($country as $each_country)
                                                                                <option {{ ($each_country->name === $user->country)?'selected':'' }} value="{{ $each_country->name }}">{{ $each_country->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Phone</label>
                                                                    <input type="text" placeholder="Phone" class="form-control" name="phone" value="{{ $user->phone }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Refferal Code</label>
                                                                    <input type="text" value="{{ $user->referral_id }}" disabled class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" placeholder="Address" class="form-control" name="address" value="{{ $user->address }}">
                                                            </div>
                                                            
                                                            <button class="btn btn-primary" type="submit">Update Account</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="account-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-8 offset-lg-2">
                                                                <h4 class="text-primary">Account Setting</h4>
                                                                <form action="{{ route('update-acct', $user->unique_id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="form-group ">
                                                                        <label>Bank Name</label>
                                                                        <input type="text" placeholder="Bank Name" class="form-control" name="bank_name" value="{{ $user->bank_name }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Account Name</label>
                                                                        <input type="text" value="{{ $user->account_name }}" placeholder="Account Name" class="form-control" name="account_name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Account Number</label>
                                                                        <input type="number" placeholder="Account Number" class="form-control" name="account_number" value="{{ $user->account_number }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Bitcoin Wallet Address</label>
                                                                        <input type="text" placeholder="Bitcoin Wallet Address" class="form-control" name="bitcoin_wallet" value="{{ $user->btc_wallet }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Etherum Wallet Address</label>
                                                                        <input type="text" placeholder="Etherum Wallet Address" class="form-control" name="etherum_wallet" value="{{ $user->eth_wallet }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Perfect Money Wallet</label>
                                                                        <input type="text" placeholder="Perfect Money Wallet" class="form-control" name="perfect_money_wallet" value="{{ $user->perfect_money_wallet }}">
                                                                    </div>
                                                                    <button class="btn btn-primary" type="submit">Update Account</button>
                                                                </form>
                                                            </div>       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="security-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-8 offset-lg-2">
                                                                <h4 class="text-primary">Security Setting</h4>
                                                                <form action="{{ route('update-password', $user->unique_id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="form-group ">
                                                                        <label>Current Password</label>
                                                                        <input type="password" placeholder="Current Password" class="form-control" name="current_password">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>New Password</label>
                                                                        <input type="password" placeholder="New Password" class="form-control" name="password">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Confrim Password</label>
                                                                        <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                                                                    </div>
                                                                
                                                                    <button class="btn btn-primary" type="submit">Update Account</button>
                                                                </form>
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
		
</body>

</html>