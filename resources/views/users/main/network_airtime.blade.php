@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Network Airtime</li>
			</ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-4">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Current Balance</h4>
                    </div>
                    <div class="card-body">
                        @if(empty($wallet))
                        <h1 class="text-center">&#8358; <?php echo number_format(0, 2)?></h1>
                        @else
                    <h1 class="text-center">&#8358; <?php echo number_format($wallet->wallet, 2)?></h1>
                    @endif
                    <img width="94" height="94" src="https://img.icons8.com/3d-fluency/94/card-wallet.png" alt="card-wallet" style="margin:0 5rem;"/>
                    </div>
                    </div>
                </div>

                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Share & Earn Money</h4>
                    </div>
                    <div class="card-body">
                    <div class="mb-3">
                                    <div class="input-group">
										<span class="input-group-text" id="copy-link"><i class="fa fa-copy" title="Copy link"></i></span>
                                        <input type="text" class="form-control border-left-end ref" id="validationCustomUsername" value="{{url('/register/?ref='.\Hashids::encode(auth()->user()->id))}}">
                                    </div>
                                </div>
                    <div class="blocks">
                    <div class="block__item"></div>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/register/?ref='.\Hashids::encode(auth()->user()->id))}}" target="_blank"><img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/facebook-circled.png" alt="facebook-circled"/></a>
                    <div class="block__item"></div>
                    <a href="https://www.instagram.com/?url={{url('/register/?ref='.\Hashids::encode(auth()->user()->id))}}"><img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/instagram-new.png" alt="instagram-new"/></a>
                    <div class="block__item"></div>
                    <a href="https://twitter.com/share?text={{url('/register/?ref='.\Hashids::encode(auth()->user()->id))}}" target="_blank"><img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/twitter-circled.png" alt="twitter-circled"/></a>
                    <div class="block__item"></div>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{url('/register/?ref='.\Hashids::encode(auth()->user()->id))}}" target="_blank"><img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/linkedin.png" alt="linkedin"/></a>
                    <div class="block__item"></div>
                </div>
                    </div>
                    </div>
                </div>
            </div>
            @if(auth::user()->agent == 1 && auth::user()->vendor == 1)
                <input type="hidden" name="charges" id="charges" value="1">
            @elseif(auth::user()->agent == 1)
             @if(!empty($agent))
                <input type="hidden" name="charges" id="charges" value="{{$agent->code}}">
                @else
                <input type="hidden" name="charges" id="charges" value="1">
                @endif
                
                 @if(!empty($cashback))
                <input type="hidden" name="charges" id="ch-back" value="{{$cashback->code}}">
                @else
                <input type="hidden" name="charges" id="ch-back" value=".5">
                @endif
            
            @elseif(auth::user()->vendor == 1)
             @if(!empty($vendor))
                <input type="hidden" name="charges" id="charges" value="{{$vendor->code}}">
                @else
                <input type="hidden" name="charges" id="charges" value="1">
                @endif
                
                 @if(!empty($cashback))
                <input type="hidden" name="charges" id="ch-back" value="{{$cashback->code}}">
                @else
                <input type="hidden" name="charges" id="ch-back" value=".5">
                @endif
            
            @else
            @if(!empty($discount))
            <input type="hidden" name="charges" id="charges" value="{{$discount->code}}">
            @else
            <input type="hidden" name="charges" id="charges" value="1">
            @endif
            
             @if(!empty($cashback))
                <input type="hidden" name="charges" id="ch-back" value="{{$cashback->code}}">
                @else
                <input type="hidden" name="charges" id="ch-back" value=".5">
                @endif
            
            @endif
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Choose Your Prefer Service Provider</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-mtn" height="50" src="{{asset('assets_1/images/mtn-air.jpg')}}" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-gol" height="50" src="{{asset('assets_1/images/glo-airtime.jpeg')}}" alt="instagram-new"/>
                    <div class="block__item"></div>
                    <img width="hidden" class="block data" id="data-airtel" height="50" src="{{asset('assets_1/images/airtel-time.png')}}" alt="twitter-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-nine" height="50" src="{{asset('assets_1/images/nine-time.jpg')}}" alt="linkedin"/>
                    <div class="block__item"></div>         
                </div>
                <!-- MTN Section -->
                    <form class="form-valide-with-icon needs-validation" id="mtn-airtime-1">
                    <h4 class="text-center">MTN AIRTIME</h4>
                    @csrf
                    <input type="hidden" value="1" id="mtn-data">
                    <input type="hidden" value="mtn" name="network">
                    <input type="hidden" id="cash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="mtn-no" placeholder="Enter Your Mobile Number">
									</div>
                                    <div class="invalid-feedback phone_no"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="hidden" id="t-amount" name="t_amount">
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="mtn-amount" placeholder="Enter Your Amount">         
                                    </div>
                                  
                                    <div class="invalid-feedback amount"></div>
                                   
                                </div>
                                
                                  <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-1" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                             
                                <h5 style="color:red; font-weight:400;display:none" id="mtn-pay-1">Amount To Pay: &#8358;<span id="mtn-pay"></span></h5>
                                <h6 id="mtn-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="mtn-cb"></span></h6>
                               

                               
                    
            <button type="submit" class="btn me-2 btn-snapchat" id="submit-data-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-data">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>


                            <!-- Gol Section -->

                    <form  class="form-valide-with-icon needs-validation" id="airtime-gol-1" style="display:none;">
                    <h4 class="text-center">GLO AIRTIME</h4>
                    @csrf
                    <input type="hidden" value="2" id="mtn-data">
                    <input type="hidden" value="glo" name="network">
                     <input type="hidden" id="gcash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="dlab-password" placeholder="Enter Your Mobile Number">
									
                                                
                                               
                                    </div>
                                    <div class="invalid-feedback phone_no"></div>
                                </div>
                                    
                                    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="hidden" id="gt-amount" name="t_amount">
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="glo-amount" placeholder="Enter Your Amount">         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                   
                                </div>
                                
                                 <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="glo-code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon-2">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-i" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                                
                                <h5 style="color:red; font-weight:400;display:none" id="glo-pay-1">Amount To Pay: &#8358;<span id="glo-pay"></span></h5>
                                <h6 id="glo-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="glo-cb"></span></h6>
                              
                                <button type="submit" class="btn me-2 btn-whatsapp" id="submit-data-2">Proceed</button>
<button class="btn btn-success" type="button" disabled style="display:none" id="submit-data-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                                    <!-- Airtel Section -->

  <form class="form-valide-with-icon needs-validation" id="airtime-airtel-1" style="display:none;">
                    <h4 class="text-center">AIRTEL AIRTIME </h4>
                    @csrf
                    <input type="hidden" value="3" id="airtel-data">
                    <input type="hidden" value="airtel" name="network">
                     <input type="hidden" id="aircash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="dlab-password" placeholder="Enter Your Mobile Number">          
                                    </div>
                                    <div class="invalid-feedback phone_no"></div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="hidden" id="ttel-amount" name="t_amount">
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="tel-amount" placeholder="Enter Your Amount">         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                   
                                </div>
                                 <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="tel-code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon-3">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-ii" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                                <h5 style="color:red; font-weight:400;display:none" id="tel-pay-1">Amount To Pay: &#8358;<span id="tel-pay"></span></h5>
                                <h6 id="air-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="air-cb"></span></h6>
                             
                                <button type="submit" class="btn me-2 btn-youtube" id="submit-data-3">Proceed</button>
                                <button class="btn btn-danger" type="button" disabled style="display:none" id="submit-data-iii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>




                             <!-- 9mobile Section -->

  <form  class="form-valide-with-icon needs-validation" id="airtime-nine-1" style="display:none;">
                    <h4 class="text-center">9MOBILE AIRTIME</h4>
                    @csrf
                    <input type="hidden" value="4" id="nine-data">
                    <input type="hidden" value="etisalat" name="network">
                     <input type="hidden" id="ncash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="dlab-password" placeholder="Enter Your Mobile Number">
                                    </div>
                                    <div class="invalid-feedback phone_no"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="hidden" id="teti-amount" name="t_amount">
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="eti-amount" placeholder="Enter Your Amount">         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                   
                                </div>
                                 <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="nin-code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon-4">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-iii" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                                <h5 style="color:red; font-weight:400;display:none" id="eti-pay-1">Amount To Pay: &#8358;<span id="eti-pay"></span></h5>
                                <h6 id="nine-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="nine-cb"></span></h6>
                                
                                <button type="submit" class="btn me-2 btn-whatsapp" id="submit-data-4">Proceed</button>
                                <button class="btn btn-success" type="button" disabled style="display:none" id="submit-data-iv">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>






                        </div>
                    </div>
                </div>
            </div>    
        </div>

             </div>
        </div>
    </div>
        </div>


        @include('users.common.footer')
