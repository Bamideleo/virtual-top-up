@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Network Bundle</li>
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
        
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                  
                        <input type="hidden" value="{{auth::user()->created_at}}" id="bonus-timer">
                        <h4 class="card-title">Choose Your Prefer Service Provider</h4>
                    </div>
                    <div class="card-body">
                   
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-mtn" height="50" src="{{asset('assets_1/images/mtn-data.jpg')}}" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-gol" height="50" src="{{asset('assets_1/images/gol-data.jpg')}}" alt="instagram-new"/>
                    <div class="block__item"></div>
                    <img width="hidden" class="block data" id="data-airtel" height="50" src="{{asset('assets_1/images/airtel.jpg')}}" alt="twitter-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-nine" height="50" src="{{asset('assets_1/images/9mobile-data.jpg')}}" alt="linkedin"/>
                    <div class="block__item"></div>         
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
                <!-- MTN Section -->
              
                    <form action="{{route('waveplus.data')}}" method="post"class="form-valide-with-icon needs-validation" id="mtn-data-1">
                    <h4 class="text-center">MTN DATA</h4>
                    @csrf
                    <input type="hidden" value="1" id="mtn-data">
                    <input type="hidden" value="01" name="service_variation">
                    <input type="hidden" id="cash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Data Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text">  <i class="fa fa-check"></i> </span>
                                    <select id="mtn-type" class="default-select form-control wide border-left-end @error('data_type') is-invalid @enderror" name="data_type" value="{{ old('data_type') }}">
									<option selected disabled>Select Data Type</option>
                                    <option value="1">SME</option>
									<option value="2">CG_LITE</option>
                                    <option value="3">GIFTING</option>
                                    <!--<option value="4">DIRECT</option>-->
								      </select>           
                                    </div>
                                    <div class="invalid-feedback data_type"></div>
                                </div>
                                <div class="mb-3" id="mtn-plan" style="display:none">
                                    <label class="text-label form-label" for="validationCustomUsername">Plans<span class="required">*</span></label>
                                    <div class="input-group">
									<span class="input-group-text">  <i class="fa fa-check"></i> </span>
                                    <select  id="mtn-plan-1" class="form-control wide border-left-end @error('plan') is-invalid @enderror" name="plan">
                                   
								      </select>                
                                    </div>
                                    <div class="invalid-feedback plan"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="p-no" placeholder="Enter Your Mobile Number">
									</div>
                                    <div class="invalid-feedback phone_no"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" id="t-amount" name="t_amount">
                                        <input type="hidden" id="tamount" name="r_amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="amount" value="{{ old('amount') }}" id="amount" disabled>         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                
                                  <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-11" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                                <h6 id="mtn-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="mtn-cb"></span></h6>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-data-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-data">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>


                            <!-- Gol Section -->

    <form  action="{{route('waveplus.data')}}" method="post" class="form-valide-with-icon needs-validation" id="data-gol-1" style="display:none;">
                    <h4 class="text-center">GLO DATA</h4>
                    @csrf
                    <input type="hidden" value="2" id="gol-data">
                    <input type="hidden" value="02" name="service_variation">
                     <input type="hidden" id="gcash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Data Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="gol-type" class="default-select form-control wide border-left-end @error('data_type') is-invalid @enderror" value="{{ old('data_type') }}" name="data_type">
									<option selected disabled>Select Data Type</option>
                                  
                                    <!--<option value="1">SME</option>-->
									 <!--<option value="2">CG_LITE</option> -->
                                    <option value="3">CG_LITE</option>
                                    <option value="4">GIFTING</option>
                                    
								      </select>
                                     
                                              
                                    </div>
                                    <div class="invalid-feedback data_type"></div>
                                </div>
                                <div class="mb-3" id="gol-plan" style="display:none">
                                    <label class="text-label form-label" for="validationCustomUsername">Plans<span class="required">*</span></label>
                                    <div class="input-group">
									<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="gol-plan-1" class="form-control wide border-left-end @error('plan') is-invalid @enderror" value="{{ old('plan') }}" name="plan">
								      </select>
                                     
                                                
                                                
                                    </div>
                                    <div class="invalid-feedback plan"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="p-no" placeholder="Enter Your Mobile Number">     
                                    </div>
                                    <div class="invalid-feedback phone_no"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" id="gt-amount" name="t_amount">
                                        <input type="hidden" id="gtamount" name="r_amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="amount" value="{{ old('amount') }}" id="gamount" disabled>         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                 <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="glo-code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon-2">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-22" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                              
                                 <h6 id="glo-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="glo-cb"></span></h6>
                                <button type="submit" class="btn me-2 btn-whatsapp" id="submit-data-2">Proceed</button>
<button class="btn btn-success" type="button" disabled style="display:none" id="submit-data-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                                    <!-- Airtel Section -->

  <form action="{{route('waveplus.data_2')}}" method="post" class="form-valide-with-icon needs-validation" id="data-airtel-1" style="display:none;">
                    <h4 class="text-center">AIRTEL DATA</h4>
                    @csrf
                    <input type="hidden" value="4" id="airtel-data">
                    <input type="hidden" value="04" name="service_variation">
                     <input type="hidden" id="aircash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Data Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="airtel-type" class="default-select form-control wide border-left-end @error('data_type') is-invalid @enderror" name="data_type" value="{{ old('data_type') }}">
									<option selected disabled>Select Data Type</option>
                                     <!-- <option value="1">SME</option>
									<option value="2">SME</option> -->
									<option value="3">SME</option>
                                    <option value="4">CG_LITE</option>
                                   
                                    
								      </select>
                                     </div>
                                     <div class="invalid-feedback data_type"></div>
                                </div>
                                <div class="mb-3" id="airtel-plan" style="display:none">
                                    <label class="text-label form-label" for="validationCustomUsername">Plans<span class="required">*</span></label>
                                    <div class="input-group">
									<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="airtel-plan-1" class="form-control wide border-left-end @error('plan') is-invalid @enderror" value="{{ old('plan') }}" name="plan">
								      </select> 
                                    </div>
                                    <div class="invalid-feedback plan"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="p-no" placeholder="Enter Your Mobile Number">          
                                    </div>
                                    <div class="invalid-feedback phone_no"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" id="at-amount" name="t_amount">
                                        <input type="hidden" id="atamount" name="r_amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="amount" value="{{ old('amount') }}" id="a-amount" disabled>         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                 <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="tel-code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon-3">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-33" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
                                 <h6 id="air-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="air-cb"></span></h6>
                                <button type="submit" class="btn me-2 btn-youtube" id="submit-data-3">Proceed</button>
                                <button class="btn btn-danger" type="button" disabled style="display:none" id="submit-data-iii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>




                             <!-- 9mobile Section -->

  <form action="{{route('waveplus.data_2')}}" method="post" class="form-valide-with-icon needs-validation" id="data-nine-1" style="display:none;">
                    <h4 class="text-center">9MOBILE DATA</h4>
                    @csrf
                    <input type="hidden" value="3" id="nine-data">
                    <input type="hidden" value="03" name="service_variation">
                     <input type="hidden" id="ncash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Data Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="nine-type" class="default-select form-control wide border-left-end @error('data_type') is-invalid @enderror" name="data_type" value="{{ old('data_type') }}">
									<option selected disabled>Select Data Type</option>
                                    <option value="3">SME</option>
                                    <option value="1">CG_LITE</option>
									<!-- <option value="2">CG_LITE</option> -->
                                    <option value="4">DIRECT</option>
									
								      </select>        
                                    </div>
                                    <div class="invalid-feedback data_type"></div>
                                </div>
                                <div class="mb-3" id="nine-plan" style="display:none">
                                    <label class="text-label form-label" for="validationCustomUsername">Plans<span class="required">*</span></label>
                                    <div class="input-group">
									<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="nine-plan-1" class="form-control wide border-left-end @error('plan') is-invalid @enderror" name="plan" value="{{ old('plan') }}">
								      </select>
                                    </div>
                                    <div class="invalid-feedback plan"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" id="p-no" placeholder="Enter Your Mobile Number">
                                    </div>
                                    <div class="invalid-feedback phone_no"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" id="nt-amount" name="t_amount">
                                        <input type="hidden" id="ntamount" name="r_amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="amount" value="{{ old('amount') }}" id="n-amount" disabled>         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                 <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="nin-code">
	                        <label class="form-check-label" for="customCheckBox1">Apply Coupon</label>
                                   
                                </div>
                                 
                                     <div class="mb-3" style="display:none"id="coupon-4">
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control border-left-end" name="coupon" id="coupon-44" placeholder="Enter Your Coupon">         
                                    </div>
                                  
                                </div>
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