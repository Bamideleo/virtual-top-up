


        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                       <img width="94" height="94" src="https://img.icons8.com/3d-fluency/94/person-male--v7.png" alt="person-male--v7"/>
                    <div class="header-info ms-3">
                        <span class="font-w600 ">Hi, {{ Auth::user()->name }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="app-profile.html" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ms-2">Logout </span>
                    </a>
                    <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>               -->
                </div>
            </li>
            <li><a  href="{{route('admin.dashboard')}}">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a></li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-users fw-bold"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.create-user')}}">Create User</a></li>
                    <li><a href="{{route('admin.get-user')}}">All Users</a></li>    
                </ul>

            </li>
            <!-- <li><a  href="javascript:void()">
                <i class="flaticon-050-info"></i>
                    <span class="nav-text">Airtime To Cash</span>
                </a>
            </li> -->
            <!-- <li><a  href="">
                <i class="flaticon-050-info"></i>
                    <span class="nav-text">Networks</span>
                </a>
            </li> -->
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Service Price</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.add-network')}}">Data Plans Price</a></li>
                    <li><a href="{{route('admin.discount-and-charge')}}">Discount</a></li>
                    <!-- <li><a href="chart-chartjs.html">Tv Cable Plans Price</a></li>
                    <li><a href="chart-chartist.html">Education Plans Price</a></li> -->
                    <!-- <li><a href="chart-sparkline.html">Sparkline</a></li>
                    <li><a href="chart-peity.html">Peity</a></li> -->
                </ul>
            </li>
            <li><a  href="{{route('admin.pay_api')}}">
                    <i class="flaticon-086-star"></i>
                    <span class="nav-text">Discount</span>
                </a>
             
            </li>
            <!-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-045-heart"></i>
                    <span class="nav-text">Reseller/Agent</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="uc-select2.html">Approved Upgrade</a></li>
                    <li><a href="uc-nestable.html">Pending Upgrade</a></li>
                </ul>
            </li> -->
            <!-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-045-heart"></i>
                    <span class="nav-text">Payment Gateways</span>
                </a>
                <ul aria-expanded="false" class="mm-collapse" style="">
                    <li><a href="widget-card.html">Widget Card</a></li>
                    <li><a href="widget-chart.html">widget Chart</a></li>
                    <li><a href="widget-list.html">Widget List</a></li>
                    
                </ul>
            </li> -->
           
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-072-printer"></i>
                    <span class="nav-text">Deposits</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.transfer')}}">Pending</a></li>
                    <li><a href="{{route('admin.all-transfer')}}">All Deposits</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-022-copy"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.payment-history')}}">Payment History</a></li>
                    <li><a href="{{route('admin.get-purchase')}}">Purchase History</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-043-menu"></i>
                    <span class="nav-text">Settings</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.api-gateway')}}">API Setting</a></li>
                    <li><a href="{{route('admin.get-email-smtp')}}">Email Setting</a></li>
                    <li><a href="{{route('admin.payment-gateway')}}">Payment Gateways</a></li>
                    <li><a href="{{route('admin.global-setting')}}">Global Setting</a></li>
                    <li><a href="{{route('admin.profile')}}">Profile</a></li>
                </ul>
            </li>
            
        </ul>
        <div class="copyright">
            <p><strong>WavePlus</strong> © 2023 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by Boltware Technology</p>
        </div>
    </div>
</div>        <!--**********************************
            Sidebar end
        ***********************************-->

@