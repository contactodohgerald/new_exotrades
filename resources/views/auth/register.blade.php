@php 
$pageTitle = "Register Page";
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
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label class="mb-1"><strong>Referral Code</strong> <small>(Optional)</small></label>
                                            @if (isset($_GET['ref']))
                                                <input type="text" class="form-control" name="referral_code" value="{{ $_GET['ref'] }}">
                                            @else
                                                <input type="text" class="form-control" placeholder="Referral Code (Optional)" name="referral_code">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>FullName</strong></label>
                                            <input type="text" class="form-control" placeholder="Full Name" name="name" :value="old('name')" required autofocus>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="mb-1"><strong>User Name</strong></label>
                                            <input type="text" class="form-control" placeholder="User Name" name="username" :value="old('username')" required autofocus>
                                        </div> --}}
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required >
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="new-password" >
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required >
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="{{ route('login') }}">Sign in</a></p>
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