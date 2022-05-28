<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="forntEnd-Developer" content="Mamunur Rashid">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="keywords" content="stock, free, trading, investing">
    <meta name="description" content="{{ env('APP_NAME') }} : Free Stock Trading & Investing Site">
    <meta name="CreativeLayers" content="ATFN">
    <meta name="MobileOptimized" content="320" />
    <meta property="og:title" content="{{ env('APP_NAME') }} : Free Stock Trading & Investing Site">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:image" content="{{env('APP_LOGO')}}">
    <meta property="og:description" content="{{ env('APP_NAME') }} : Free Stock Trading & Investing Site">
    <meta property="og:site_name" content="{{ env('APP_NAME') }} : Free Stock Trading & Investing Site">
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="415" />
    <meta property="og:image:secure_url" content="{{env('APP_LOGO')}}" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="GOOGLEBOT" content="index follow"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#d49a3a" />

	<title> {{ env('APP_NAME') }} - {{ $pageName }}</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/plugin.css')}}">

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css')}}">
</head>