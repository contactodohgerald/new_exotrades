@php 
$pageTitle = "Edit Profile Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Profile</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs" style="margin-bottom: 1em">
                                            <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link active show">Basic Setting</a>
                                            </li>
                                            </li>
                                            <li class="nav-item"><a href="#security-settings" data-toggle="tab" class="nav-link">Password Setting</a>
                                            </li>
                                            <li class="nav-item"><a href="#profile-image" data-toggle="tab" class="nav-link">Profile Image Setting</a>
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
                                                                    <label>Phone</label>
                                                                    <input type="text" placeholder="Phone" class="form-control" name="phone" value="{{ $user->phone }}">
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
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" placeholder="Address" class="form-control" name="address" value="{{ $user->address }}">
                                                            </div>
                                                            
                                                            <button class="btn btn-primary" type="submit">Update Account</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="security-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-8 offset-lg-2">
                                                                <h4 class="text-primary">Security Setting</h4>
                                                                <!-- Validation Errors -->
                                                                <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
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
                                            <div id="profile-image" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-8 offset-lg-2">
                                                                <h4 class="text-primary">Profile Image Setting</h4>
                                                                <center>
                                                                    <div style="width: 200px; height: 200px; border-radius: 50%; border: 3px solid grey;">
                                                                        <img src="{{($user->avatar == 'avatar.png') ? 'images/avatar.png' : $user->avatar}}" alt="{{$user->name}}" width="100%" height="100%" />
                                                                    </div>
                                                                </center>
                                                                <form action="{{ route('update-profile-image', $user->unique_id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group ">
                                                                        <label>Select Image</label>
                                                                        <input type="file" class="form-control" name="thumbnail" required>
                                                                    </div>                                                              
                                                                    <button class="btn btn-primary" type="submit">Upload Image</button>
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