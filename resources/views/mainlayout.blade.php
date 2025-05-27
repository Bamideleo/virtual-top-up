<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

  <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="zBdQfqCQB7KKvNJ6z6LGuIDfEmuVhM8Il8vc1OAF">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="bootstrap public, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description" content="Some description for the page">
    <meta property="og:title" content="Dompet - Payment public Dashboard Bootstrap Template">
    <meta property="og:description" content="Laravel | Dashboard">
    <meta property="og:image" content="../social-image.png">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets_1/images/cheap-data-airtime-in-nigeria.png')}}">

    <!-- Page Title Here -->
    <title>VTU-BUSINESS-MODEL</title>
    
         
                    <link href="{{asset('assets_1/vendor/nouislider/nouislider.min.css')}}" rel="stylesheet" type="text/css"/>
              

    
     
                    <link href="{{asset('assets_1/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css"/>
                    <link href="{{asset('assets_1/css/style.css')}}" rel="stylesheet" type="text/css"/>
                    <link href="{{asset('assets_1/vendor/toastr/css/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
             
    
</head>
<body>

<!-- preload section -->


<div id="preloader">
        <div class="waviy">
           <span style="--i:1">L</span>
           <span style="--i:2">O</span>
           <span style="--i:3">A</span>
           <span style="--i:4">D</span>
           <span style="--i:5">I</span>
           <span style="--i:6">N</span>
           <span style="--i:7">G</span>
           <span style="--i:8">.</span>
           <span style="--i:9">.</span>
           <span style="--i:10">.</span>
           <span style="--i:11">.</span>
        </div>
    </div>


    <div id="main-wrapper">


    @yield('content')

</div>




  
            
        
</body>


</html>