


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
                        <span class="font-w600 ">Hi, {{ Auth::user()->first_name }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{route('wavepluse.profile')}}" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <a href="{{route('user.logout')}}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ms-2">Logout </span>
                    </a>
                
                </div>
            </li>
          
            <li><a  href="{{route('home')}}">
                    <i><img width="25" height="25" src="https://img.icons8.com/dotty/80/dashboard.png" alt="dashboard"/></i>
                    <span class="nav-text">Dashboard</span>
                </a></li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i><img width="25" height="25" src="https://img.icons8.com/ios/50/wifi--v1.png" alt="wifi--v1"/></i>
                    <span class="nav-text">Buy Data</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('network.buy-data')}}">Network Data</a></li>
                    <li><a href="{{route('network.smile-data')}}">Smile Data</a></li>  
                    <li><a href="{{route('network.spectratnet-data')}}">Specratnet Data</a></li>    
                </ul>

            </li>

            
           
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i><img width="25" height="25" src="https://img.icons8.com/wired/64/phone.png" alt="phone"/></i>
                    <span class="nav-text">Buy Airtime</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('network.airtime')}}">VTU Airtime</a></li>
                   
                </ul>
            </li>
            
            <li><a  href="{{route('tv.subscription')}}">
                <i ><img width="25" height="25" src="https://img.icons8.com/external-those-icons-lineal-those-icons/24/external-TV-hotel-those-icons-lineal-those-icons.png" alt="external-TV-hotel-those-icons-lineal-those-icons"/></i>
                    <span class="nav-text">Tv Subscription</span>
                </a>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i><img width="25" height="25" src="https://img.icons8.com/carbon-copy/100/light-on.png" alt="light-on"/></i>
                    <span class="nav-text">Buy Electricity</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('ibadan.electric')}}">IBEDC Ibadan Electric Payment</a></li>
                    <li><a href="{{route('electricity.bill')}}">IKEDC Ikeja Electric Payment</a></li>
                    <li><a href="{{route('eko.electric')}}">EKEDC Eko Electric Payment</a></li>
                    <li><a href="{{route('kano.electric')}}">KEDCO Kano Electric Payment</a></li>
                    <li><a href="{{route('harcourt.electric')}}">PHED Port Harcourt Electric Payment</a></li>
                    <li><a href="{{route('jos.electric')}}">JED Jos Electric Payment</a></li>
                    <li><a href="{{route('kaduna.electric')}}">KAEDCO Kaduna Electric Payment</a></li>
                    <li><a href="{{route('abuja.electric')}}">AEDC Abuja Electric Payment</a></li>
                    <li><a href="{{route('benin.electric')}}">BEDC Benin Electric Payment</a></li>
                    <li><a href="{{route('enugu.electric')}}">EEDC Enugu Electric Payment</a></li>
                </ul>
            </li>

            <!-- <li><a  href="{{route('electricity.bill')}}">
                    <i class="flaticon-086-star"></i>
                    <span class="nav-text">Buy Electricity</span>
                </a>
             
            </li> -->

            <!-- <li><a  href="javascript:void()">
                    <i class="flaticon-086-star"></i>
                    <span class="nav-text">Bet9ja Payment</span>
                </a>
             
            </li> -->

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i><img width="25" height="25" src="https://img.icons8.com/ios/50/exam.png" alt="exam"/></i>
                    <span class="nav-text">Exams Pins</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('wace.registration')}}">WAEC </a></li>
                    <!-- <li><a href="">JAMB Pin</a></li> -->
                    <!-- <li><a href="{{route('kano.electric')}}">KEDCO Kano Electric Payment</a></li>
                    <li><a href="{{route('harcourt.electric')}}">PHED Port Harcourt Electric Payment</a></li>
                    <li><a href="{{route('jos.electric')}}">JED Jos Electric Payment</a></li>
                    <li><a href="{{route('kaduna.electric')}}">KAEDCO Kaduna Electric Payment</a></li>
                    <li><a href="{{route('abuja.electric')}}">AEDC Abuja Electric Payment</a></li>
                    <li><a href="{{route('benin.electric')}}">BEDC Benin Electric Payment</a></li>
                    <li><a href="{{route('enugu.electric')}}">EEDC Enugu Electric Payment</a></li> -->
                </ul>
            </li>




            <!--<li><a  href="javascript:void()">-->
            <!--        <i><img width="25" height="25" src="https://img.icons8.com/ios/50/pos-terminal--v1.png" alt="pos-terminal--v1"/></i>-->
            <!--        <span class="nav-text">Pos Terminal</span>-->
            <!--    </a>-->
             
            <!--</li>-->
           
           
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i><img width="25" height="25" src="https://img.icons8.com/dotty/80/card-in-use.png" alt="card-in-use"/></i>
                    <span class="nav-text">Payment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('credit.wallet')}}">Credit Wallet</a></li>
                    <li><a href="{{route('share.wallet')}}">Share Wallet</a></li>
                    <!--<li><a href="{{route('credit.history')}}">Payment History</a></li>-->
                    <li><a href="{{route('transfer.history')}}">Transfer History</a></li>
                </ul>
            </li>
            <li><a  href="{{route('purchase.history')}}">
            <i><img width="25" height="25" src="https://img.icons8.com/wired/64/purchase-order.png" alt="purchase-order"/></i>
                    <span class="nav-text">Purchase History</span>
                </a>
              </li>

              <li><a  href="{{route('wavepluse.reseller')}}">
                <i><img width="25" height="25" src="https://img.icons8.com/dotty/80/reseller.png" alt="reseller"/></i>
                    <span class="nav-text">Reseller</span>
                </a>
            </li>
            
              <li><a  href="{{route('wavepluse.price')}}">
                    <i><img width="25" height="25" src="https://img.icons8.com/ios/50/price-tag--v1.png" alt="price-tag--v1"/></i>
                    <span class="nav-text">Pricing</span>
                </a>
              </li>
          
              <li><a  href="{{route('send-notification')}}">
              <i><img width="25" height="25" src="https://img.icons8.com/dotty/80/gender-neutral-user.png" alt="gender-neutral-user"/></i>
              <span class="nav-text">Customer Support</span>
              </a>
              </li>
           
          
              
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i><img width="25" height="25" src="https://img.icons8.com/ios/50/settings--v1.png" alt="settings--v1"/></i>
                    <span class="nav-text">Settings</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('wavepluse.profile')}}">Profile</a></li>
                </ul>
            </li>
            
        </ul>
        <div class="copyright">
           
            <p><strong>Boltware</strong> © {{date('Y')}} All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by Boltware Technology</p>
        </div>
    </div>
</div>        <!--**********************************
            Sidebar end
        ***********************************-->

