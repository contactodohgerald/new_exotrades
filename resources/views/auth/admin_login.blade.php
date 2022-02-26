@php 
$pageTitle = "Admin Access Code Page";
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
                                    <h4 class="text-center mb-4">Admin Access Code</h4>
                                    @if (session('error'))
                                        <div class="mb-4 font-medium text-sm text-green-600 text-center text-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('grant-access') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Access Code</strong></label>
                                            <input type="password" class="form-control" :value="old('access_code')" required autofocus name="access_code" placeholder="Access Code">
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Allow Access</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Navigate back to <a class="text-primary" href="./">Home</a></p>
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