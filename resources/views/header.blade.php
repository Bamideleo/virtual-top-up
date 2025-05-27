<!DOCTYPE html>
<html lang="eng">
<head>
<meta charset="utf-8">
<meta name="description" content="vtu business model">
<meta name="keywords" content="HTML,CSS,JavaScript">
<meta name="author" content="HiBootstrap">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<title>VTU Business Model</title>
<link rel="icon" href="{{asset('assets/images/tab.png')}}" type="image/png" sizes="16x16">

<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" type="text/css" media="all" />
<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/meanmenu.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/boxicons.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" type="text/css" media="all" />

<link rel="stylesheet" href="{{asset('assets/css/theme-dark.css')}}" type="text/css" media="all" />
</head>
<body>

<div class="preloader orange-gradient">
<div class="preloader-wrapper">
<div class="preloader-grid">
<div class="preloader-grid-item preloader-grid-item-1"></div>
<div class="preloader-grid-item preloader-grid-item-2"></div>
<div class="preloader-grid-item preloader-grid-item-3"></div>
<div class="preloader-grid-item preloader-grid-item-4"></div>
<div class="preloader-grid-item preloader-grid-item-5"></div>
<div class="preloader-grid-item preloader-grid-item-6"></div>
<div class="preloader-grid-item preloader-grid-item-7"></div>
<div class="preloader-grid-item preloader-grid-item-8"></div>
<div class="preloader-grid-item preloader-grid-item-9"></div>
</div>
</div>
</div>


<div class="fixed-top">
<div class="navbar-area">
@php
$site_info = DB::table('global_settings')->where('id',1)->first();
@endphp
<div class="mobile-nav">
<a href="/" class="logo">
<img src="{{asset('images/'.$site_info->site_logo)}}" class="logo1" alt="logo" style="width:50px; height:50px">
<img src="{{asset('images/'.$site_info->site_logo)}}" class="logo2" alt="logo" style="width:50px; height:50px">
</a>
<div class="navbar-option-item">
<a href="{{route('register')}}">
<i class="flaticon-login"></i>
</a>
</div>
</div>
</div>

<div class="main-nav">
<div class="container-fluid">
<nav class="navbar navbar-expand-md navbar-light">
<a class="navbar-brand" href="/">
<img src="{{asset('images/'.$site_info->site_logo)}}" class="logo1" alt="logo" style="width:50px; height:50px">
<img src="{{asset('images/'.$site_info->site_logo)}}" class="logo2" alt="logo" style="width:50px; height:50px">
</a>
<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
<ul class="navbar-nav mx-auto">
<li class="nav-item">
<a href="#" class="nav-link active">Home</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">About Us</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">Services</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">Contact Us</a>
</li>
</ul>
</div>

<div class="navbar-option-item">
<a href="{{route('register')}}" class="btn1 blue-gradient btn-with-image text-nowrap">
<i class="flaticon-login"></i>
<i class="flaticon-login"></i>
Sign Up 
</a>
</div>
</div>
</nav>
</div>
</div>
</div>
</div>
@yield('content')


@include('footer')


