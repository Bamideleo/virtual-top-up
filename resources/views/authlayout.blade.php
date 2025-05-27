<!DOCTYPE html>
<html lang="en" class="h-100">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

@php
$site_info = DB::table('global_settings')->where('id',1)->first();
@endphp

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="zBdQfqCQB7KKvNJ6z6LGuIDfEmuVhM8Il8vc1OAF">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="VTU cheapest data airtime pos terminal cable subscription tv subscription">
    <meta name="description" content="waveplus">
    <meta property="og:title" content="Waveplus">
    <meta property="og:description" content="waveplus">
    <meta property="og:image" content="Waveplus">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- PWA  -->
<meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{asset('images/'.$site_info->site_logo)}}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/'.$site_info->site_logo)}}">

    <!-- Page Title Here -->
    <title>VTU-BUSINESS-MODEL</title>
    
    <link href="{{asset('assets_1/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets_1/css/style.css')}}" rel="stylesheet">
    
</head>

<body class="vh-100">




@yield('content')



<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->

<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>

<script src="{{asset('assets_1/vendor/global/global.min.js')}}" type="text/javascript"></script>
                <script src="{{asset('assets_1/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}" type="text/javascript"></script>
                    <script src="{{asset('assets_1/js/custom.min.js')}}" type="text/javascript"></script>
                <script src="{{asset('assets_1/js/dlabnav-init.js')}}" type="text/javascript"></script>
                <script src="{{asset('assets_1/js/demo.js')}}" type="text/javascript"></script>
                <script src="{{asset('assets_1/js/styleSwitcher.js')}}" type="text/javascript"></script>
    
</body>

</html>