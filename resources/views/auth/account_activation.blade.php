@php 
$pageTitle = "Account Activation Page";
@endphp
@include('includes.auth_head')

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12 col-lg-12 mt-3">
                                <center>
                                    <a href="/" class="brand-logo">
                                        <img src="{{ asset('favicon.png') }}" alt="{{env('APP_NAME')}}">
                                    </a>
                                </center>
                            </div>
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Account Activation</h4>
                                    <div class="col-sm-12">
                                        @if (session('success'))
                                            <p class="alert alert-success">{{session('success')}}</p>
                                        @endif
                                        @if (session('error'))
                                            <p class="alert alert-warning">{{session('error')}}</p>
                                        @endif
                                    </div>
                                    <form action="{{route('activate_account', ['account-activation', $user_id])}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Enter Activation Code</strong></label>
                                            <input type="text" class="form-control" :value="old('token')" required autofocus name="token" placeholder="Enter Activation Code">
                                            @error('activation_code')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>           
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Activate Account</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <a href="{{route('send_account_activation_code', [$user_id, 'account-activation'])}}" class="float-right ">Resend Code</a>
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
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('includes.auth_footer')

</body>

</html>