<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

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
	
	
    <title>{{ env('APP_NAME') }} | @php print @$pageTitle @endphp</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
 
</head>