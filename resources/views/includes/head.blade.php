<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
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
	
    <title>{{ env('APP_NAME', 'BinnaceExtra') }} | @php print @$pageTitle @endphp</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">

	<!-- Datatable -->
	<link href="{{ asset('backend/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('backend/vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/css/mystyle.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/css/mainCss.css') }}" rel="stylesheet">

    <!-- include summernote css/js -->
    <link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">

</head>