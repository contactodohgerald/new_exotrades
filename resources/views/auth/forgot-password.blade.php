@php 
$pageTitle = "Forget Password Page";
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
                                    <h4 class="text-center mb-4">Forgot Password</h4>
                                    <div class="alert alert-success">
                                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset token to help you set up a new one.') }}
                                    </div>

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                    <form action="{{ route('send-reset-password-token') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" :value="old('email')" required autofocus placeholder="Email">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Email Reset Token</button>
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