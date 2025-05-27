@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">TV Subscription</li>
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
                        <h4 class="card-title">Choose Your Prefer Service Provider</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    <div class="block__item"></div>
                    <img width="100" class="block data" id="data-mtn" height="100" src="{{asset('assets_1/images/dstv.webp')}}" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img width="100" class="block data" id="data-gol" height="100" src="{{asset('assets_1/images/gotv.webp')}}" alt="instagram-new"/>
                    <div class="block__item"></div>
                    <img width="100" class="block data" id="data-airtel" height="100" src="{{asset('assets_1/images/startimes.jpg')}}" alt="twitter-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-nine" height="50" src="{{asset('assets_1/images/showmax.webp')}}" alt="linkedin"/>
                    <div class="block__item"></div>       
                </div>
                <!-- MTN Section -->
                 @if(auth::user()->agent == 1 && auth::user()->vendor == 1)
                <input type="hidden" name="charges" id="charges" value="1">
            @elseif(auth::user()->agent == 1)
             @if(!empty($agent))
                <input type="hidden" name="charges" id="charges" value="{{$agent->code}}">
                @else
                <input type="hidden" name="charges" id="charges" value="1">
                @endif
            
            @elseif(auth::user()->vendor == 1)
             @if(!empty($vendor))
                <input type="hidden" name="charges" id="charges" value="{{$vendor->code}}">
                @else
                <input type="hidden" name="charges" id="charges" value="1">
                @endif
            
            @else
            @if(!empty($discount))
            <input type="hidden" name="charges" id="charges" value="{{$discount->code}}">
            @else
            <input type="hidden" name="charges" id="charges" value="1">
            @endif
            @endif
                    <form class="form-valide-with-icon needs-validation" id="dstv">
                    <h4 class="text-center">DSTV Subscription</h4>
                    @csrf
                    <input type="hidden" value="dstv" name="type">
                    <input type="hidden" value="dstv" name="service">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smartcard Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i></span>
                                        <input type="text" class="form-control border-left-end @error('smartcard_number') is-invalid @enderror" name="smartcard_number" value="{{ old('smartcard_number') }}" id="sm-card-" placeholder="Enter Your smartcard Number">
									</div>
                                    <div class="invalid-feedback smartcard_number"></div>

                                </div>
                                <!-- <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="dlab-password" placeholder="Enter Your Amount">         
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div> -->
                                <button type="submit" class="btn me-2 btn-twitter" id="submit-data-1">Proceed</button>
            <button class="btn btn-primary" type="button" disabled style="display:none" id="submit-data">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Verifying....</span></button>
                            </form>


                            <!-- Gol Section -->

                    <form  class="form-valide-with-icon needs-validation" id="gotv" style="display:none;">
                    <h4 class="text-center">GOTV Subscription</h4>
                    @csrf
                    <input type="hidden" value="gotv" name="type">
                    <input type="hidden" value="gotv" name="service">
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smartcard Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('smartcard_number') is-invalid @enderror" name="smartcard_number" value="{{ old('smartcard_number') }}" id="sm-card-1" placeholder="Enter Your smartcard Number">
									</div>
                                    <div class="invalid-feedback smartcard_number"></div>

                                </div>
                                <!-- <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="dlab-password" placeholder="Enter Your Amount">
										
                                               
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div> -->
                                <button type="submit" class="btn me-2 btn-youtube" id="submit-data-2">Proceed</button>
<button class="btn btn-success" type="button" disabled style="display:none" id="submit-data-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Verifying....</span></button>
                            </form>



                                    <!-- Airtel Section -->

  <form class="form-valide-with-icon needs-validation" id="startimes" style="display:none;">
                    <h4 class="text-center">StarTimes Subscription</h4>
                    @csrf
                    <input type="hidden" value="startimes" name="type">
                    <input type="hidden" value="startimes" name="service">
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smartcard Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('smartcard_number') is-invalid @enderror" name="smartcard_number" value="{{ old('smartcard_number') }}" id="sm-card-3" placeholder="Enter Your smartcard Number">
									</div>
                                    <div class="invalid-feedback smartcard_number"></div>

                                </div>
                                <!-- <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="dlab-password" placeholder="Enter Your Amount">                                
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div> -->
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-data-3">Proceed</button>
                                <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-data-iii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Verifying....</span></button>
                            </form>

        

                             <!-- DSTV Section -->
                             @if(!empty($discount))
                                        <input type="hidden" name="charges" id="charges" value="{{$discount->code}}">
                                        @else
                                        <input type="hidden" name="charges" id="charges" value="2">
                                        @endif
  <form  class="form-valide-with-icon needs-validation" id="dstv-1" style="display:none;">
                    <h4 class="text-center">Username: <span id="username"></span></h4>
                    <h4 class="text-center">Current Bouquet: <span id="bouquet"></span></h4>
                    <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="4" id="nine-data">
                    <input type="hidden" value="dstv" name="service">
                                        
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smartcard<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"><i class="fa fa-credit-card"></i> </span>
                                        <!-- value coming from the DB -->
                                        <input type="hidden" name="smartcard_number" id="s-card">
                                        <input type="text" class="form-control border-left-end" name="smartcard_no"  id="smart-card-1" disabled>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-tv"></i> </span>
                                    <select id="dstv-type" class="form-control wide border-left-end @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}">
						
								      </select>
                                     </div>
                                     <div class="invalid-feedback type"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number"  placeholder="Enter Your Phone Number">          
                                    </div>

                                    <div class="invalid-feedback phone_number"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Subscription Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    <select id="airtel-type" class="default-select form-control wide border-left-end @error('subscription_type') is-invalid @enderror" name="subscription_type" value="{{ old('type') }}">
									<option selected disabled>Select Type</option>
                                    <option value="change">Change</option>
									<option value="renew">renew</option>
								      </select>
                                     </div>
                                     <div class="invalid-feedback subscription_type"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"><i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="amount" placeholder="Enter Your Amount">          
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="hidden" name="t_amount" id="dstv-amount">  
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end "  id="t-amount" disabled>          
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            
                                <button type="submit" class="btn me-2 btn-twitter" id="submit-data-4">Proceed</button>
                                <button class="btn btn-primary" type="button" disabled style="display:none" id="submit-data-iv">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                             <!-- GOTV Section -->
                         
                <form  class="form-valide-with-icon needs-validation" id="gotv-1" style="display:none;">
                <h4 class="text-center">Username: <span id="username-1"></span></h4>
                    <h4 class="text-center">Current Bouquet: <span id="bouquet-1"></span></h4>
                    <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="gotv" name="service">

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smartcard<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"><i class="fa fa-credit-card"></i> </span>
                                        <!-- value coming from the DB -->
                                        <input type="hidden" name="smartcard_number" id="s-card-1">
                                        <input type="text" class="form-control border-left-end" name="smartcard_no"  id="smart-card-11" disabled>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-tv"></i> </span>
                                    <select id="gotv-type" class="form-control wide border-left-end @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}">
								      </select>
                                     </div>
                                     <div class="invalid-feedback type"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number"  placeholder="Enter Your Phone Number">          
                                    </div>

                                    <div class="invalid-feedback phone_number"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Subscription Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    <select id="airtel-type" class="default-select form-control wide border-left-end @error('subscription_type') is-invalid @enderror" name="subscription_type" value="{{ old('type') }}">
									<option selected disabled>Select Type</option>
                                    <option value="change">Change</option>
									<option value="renew">renew</option>
								      </select>
                                     </div>
                                     <div class="invalid-feedback subscription_type"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"><i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="go-amount" placeholder="Enter Your Amount">          
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="hidden" name="t_amount" id="gotv-amount">  
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end "  id="gt-amount" disabled>          
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" class="btn me-2 btn-whatsapp" id="submit-data-go-1">Proceed</button>
                                <button class="btn btn-success" type="button" disabled style="display:none" id="submit-data-go">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>


                          <!-- startimes Section -->
                          <form  class="form-valide-with-icon needs-validation" id="startimes-1" style="display:none;">
                    <h4 class="text-center">Username: <span id="username-2"></span></h4>
                    <h4 class="text-center">Current Balance: &#8358;<span id="bouquet-2"></span></h4>
                    <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="4" id="nine-data">
                    <input type="hidden" value="startimes" name="service">

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smartcard<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <!-- value coming from the DB -->
                                        <input type="hidden" name="smartcard_number"  id="s-card-ii">
                                        <input type="text" class="form-control border-left-end" name="smartcard_no"  id="s-card-2" disabled>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-tv"></i> </span>
                                    <select id="star-times" class="form-control wide border-left-end @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}">
								      </select>
                                     </div>
                                     <div class="invalid-feedback type"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number"  placeholder="Enter Your Phone Number">          
                                    </div>

                                    <div class="invalid-feedback phone_number"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"><i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="sts-amount" placeholder="Enter Your Amount">          
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="hidden" name="t_amount" id="star-time-amount">  
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end "  id="st-amount" disabled>          
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-data-star">Proceed</button>
                                <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-data-star-1">
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