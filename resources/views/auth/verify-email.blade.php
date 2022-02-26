@php 
$pageTitle = "Verify Email Page";
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
                                    <h4 class="text-center mb-4">Verify Email</h4>
                                    <div class="alert alert-success">
                                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </div>

                                    @if (session('status') == 'verification-link-sent')
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
                        
                                        <div class="text-center">
                                            <x-button>
                                                {{ __('Resend Verification Email') }}
                                            </x-button>
                                        </div>
                                    </form>
                        
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Log Out</button>
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