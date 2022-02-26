@php 
$pageTitle = "Verify Token Page";
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
                                    <h4 class="text-center mb-4">Verify Token</h4>
                                    <div class="alert alert-success">
                                        {{ __('Please provide the token that was sent to your email to continue wuth the process of updating your password') }}
                                    </div>

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4 text-center text-success" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />

                                    @if(session('error'))
                                        <p class="mb-4 text-center text-danger">{{ session('error') }}</p>
                                    @endif

                                    <form action="{{ route('verify-reset-password-token', $userId) }}" method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label><strong>Token</strong></label>
                                            <input type="number" class="form-control" name="token" required autofocus placeholder="Token">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Verify Token</button>
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