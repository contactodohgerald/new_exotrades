@php 
$pageTitle = "Reset Password Page";
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
                                    <h4 class="text-center mb-4">Reset Password</h4>
                                    <!-- Validation Errors -->
                                     <!-- Validation Errors -->
                                     <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />

                                     @if(session('error'))
                                         <p class="mb-4 text-center text-danger">{{ session('error') }}</p>
                                     @endif

                                    <form action="{{ route('reset-password', $userId) }}" method="POST">
                                        @csrf

                                        <!-- Password Reset Token -->
                                        <input type="hidden" class="form-control" name="token" value="{{$userId}}">

                                        <div class="form-group">
                                            <label class="mb-1"><strong>New Password</strong></label>
                                            <input type="password" class="form-control" type="password" name="password" required placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input type="password" class="form-control" type="password" name="password_confirmation" required placeholder="Confrim Password">
                                        </div>
                                       
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                        </div>
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
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('includes.auth_footer')

</body>

</html>