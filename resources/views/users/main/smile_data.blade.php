@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Smile Bundle</li>
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
                    < <div class="block__item"></div>
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
                        <h4 class="card-title">Choose Your Plan</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    <!-- <div class="block__item"></div> -->
                    <img class="block data" id="data-mt" style="width:100px;height:100px;" src="{{asset('assets_1/images/smile.png')}}" alt="facebook-circled"/>
                    <!-- <div class="block__item"></div>
                    <img style="width:100px;height:100px;" class="block data" id="data-gol"  src="{{asset('public/images/smile-voice.png')}}" alt="instagram-new"/>
                    <div class="block__item"></div>          -->
                </div>
                <!-- MTN Section -->
                    <form class="form-valide-with-icon needs-validation" action="{{route('waveplus.smile-data')}}" method="post" id="smile-data-1">
                    <h4 class="text-center">SMILE DATA</h4>
                                @csrf
                                <input type="hidden" name="data_type" value="smile-direct">
                               
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Smile Email<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                        <input type="email" class="form-control border-left-end" id="dlab-password" name="email" value="{{ old('email') }}" placeholder="Enter Your Smile Registered Email">
                                    </div>
                                    <div class="invalid-feedback email"></div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="text" class="form-control border-left-end" id="dlab-password" placeholder="Enter Your Amount" required>
										
                                        <div class="invalid-feedback">
											Please Enter a username.
										</div>
                                    </div>
                                </div> -->
                                <button type="submit" class="btn me-2 btn-success" id="sumbmit-smile">Proceed</button>
                                <button class="btn btn-success" type="button" disabled style="display:none" id="submit-smile-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Verifying....</span></button>
                            </form>


                            <!-- Gol Section -->

                    <form class="form-valide-with-icon needs-validation" id="smile-recharge" style="display:none;">
                    <h4 class="text-center">Recharge Smile Account</h4>
                    @csrf
                    <input type="hidden" value="" name="vcode">
                                        <h4 class="text-center">Username: <span id='username'></span></h4>
                                        <h4 class="text-center">Account Verified</h4>
                                 <h4 class="text-center" style="display:none;color:blue" id="cas-b">Cashback: &#8358;<span id="cash-b"></span></h4>
                                <input type="hidden" class="form-control border-left-end" id="account-id" name="accountId">
                                <input type="hidden" id="cash-back" name="cash_back">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text">  <i class="fa fa-check"></i> </span>
                                    <select class="form-control wide border-left-end" name="type" id="smile-type">
                                   
								      </select>
                                    </div>
                                    <div class="invalid-feedback type"></div>
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
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Phone Number<span class="required">*</span></label>
                                    <div class="input-group">
									<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                    <input type="text" class="form-control border-left-end" id="dlab-password" name="phone_number" placeholder="Enter Your Phone Number">
                                    </div>
                                    <div class="invalid-feedback phone_number"></div>
                                </div>
                                <input type="hidden" name="t_amount" id="t-amount">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="amount" id="spec-amount" disabled>
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                <button type="submit" class="btn me-2 btn-success" id="submit-charge">Proceed</button>
                                <button class="btn btn-success" type="button" disabled style="display:none" id="submit-charge-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">processing....</span></button>
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