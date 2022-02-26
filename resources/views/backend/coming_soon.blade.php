
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Chrev : Crypto Admin Template" />
	<meta property="og:title" content="Chrev : Crypto Admin Template" />
	<meta property="og:description" content="Chrev : Crypto Admin Template" />
	<meta property="og:image" content="page-error-404.html" />
	
	
    <title>{{env('APP_NAME')}} - Coming Soon</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend/images/favicon.png')}}">
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h1 class="text-danger">COMING SOON</h1>
                        <h4><i class="fa fa-exclamation-triangle text-warning"></i> </h4>
                        <p>The entire team of {{env('APP_NAME')}} is working effrortily and tiresily to make sure that your experiencr and expectations are meant and as such we would want you to continue exploring other awesome features of {{env('APP_NAME')}} Thank You.</p>
                        <div>
                            <a class="btn btn-primary" href="{{route('dashboard')}}">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<!-- Required vendors -->
<script src="{{asset('backend/vendor/global/global.min.js') }}"></script>
<script src="{{asset('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{asset('backend/js/custom.min.js') }}"></script>
<script src="{{asset('backend/js/deznav-init.js') }}"></script>

</html>