@extends('mainlayout')
@section('content')
@php
$site_info = DB::table('global_settings')->where('id',1)->first();
@endphp
  <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
            <img  src="{{asset('images/'.$site_info->site_logo)}}" alt="" style="width:50px;height:50px">
            </a>
            <a href="{{route('home')}}" class="brand-logo-i m-t-5">
                <p>&nbsp;</p>
                <img  src="{{asset('images/'.$site_info->site_logo)}}" alt="" style="width:50px;height:50px">
            </a>
          
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>


        <!-- Header start -->
<!-- *********************************** -->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                       {{$title}}               </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item">
                        <div class="input-group search-area">
                            <input type="text" class="form-control" placeholder="Search here...">
                            <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('credit.wallet')}}" class="btn btn-primary d-sm-inline-block">Credit Wallet</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>       
@include('users.common.sider_bar')
@endsection