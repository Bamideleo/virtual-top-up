@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Reseller</li>
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
                      <h4 class="card-title">Reseller Package</h4>
                    </div>
                    <div class="card-body">
                    @if(Session::has('message'))
                                    
                                    @elseif(Session::has('success'))
                                    <div class="alert alert-primary solid alert-end-icon alert-dismissible fade show">
                                            <span><i class="mdi mdi-account-search"></i></span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                            </button> {{ Session::get('success', '') }}
                                        </div>
                                        @elseif(Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error', '') }}
                                            </div>       
                                                      @endif
                        <div class="basic-form">
                    <!-- <div class="mb-3 blocks">
                    <div class="block__item"></div>
                    <img  class="block data" id="data-mtn" style="width:100px; height:100px;" src="{{asset('public/images/paystack.png')}}" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img class="block data" id="data-gol" title="Transfer Money" width="94" height="94" src="https://img.icons8.com/3d-fluency/94/money-transfer.png" alt="money-transfer"/>
                    <div class="block__item"></div> -->
                    <h6 style="color:red">Please note that there is non-refundable fee of &#8358;2000 if you are upgrading to a vendor account.</h6>
                    <h6 style="color:red">Please note that there is non-refundable fee of &#8358;1500 if you are upgrading to an Agent account.</h6>
                </div>
                <!-- MTN Section -->
                <br>
                    <form action="{{route('paystack')}}" method="post" class="form-valide-with-icon needs-validation" id="paystack" style="display:none;">
                        <h4 class="text-center">Pay With Paystack</h4>
                        @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                       
                                        <input type="hidden" id="total-amount" name="t_amount">
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" id="paystack-pay" value="{{ old('amount') }}"  name="amount" placeholder="Enter Your Amount">
                                        @error('amount')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                   
                                </div>
                                <div class="">
                                <p style="font-size:18px; display:none" id="tran">Transaction charge:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>&#8358;</span>&nbsp;<span id="paystack-charges-1"></span></p>
                                <p style="font-size:18px; display:none" id="tran-1">Amount to credited:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;font-weight:bold">&#8358;</span>&nbsp;<span id="total-amount-1" style="color:red;font-weight:bold"></span></p>
                                </div>
                                <button type="submit" class="btn me-2 btn-primary" id="submit-paystack-2">Proceed</button>
                            </form>


                            <!-- Gol Section -->
                       
                            <div class="row" id="tran-money">
                            <div class="col-md-6">

                            <div >
                            <h4>Upgrade to vendor account and earn <b>&#8358;500</b> on every referral commission with <b>2%</b> charge on all services</h4>
                            <br>
                            <h4>Upgrade to agent account and earn <b>&#8358;250</b> on every referral commission with <b>1%</b> charge on all services</h4>
                            </div> 
                                </div>
                            <div class="col-md-6">   
                <form class="form-valide-with-icon needs-validation" action="{{route('wavepluse.up_reseller')}}" method="POST">
                    @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Plans<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                     <select class="default-select form-control wide border-left-end" name="plan">
									<option selected disabled>Select Plan</option>
                                    <option value="1">Agent</option>
                                    <option value="2">Vendor</option>
								      </select>          
                                    </div>
                                    <div class="invalid-feedback plan"></div>
                                </div>
          <!--                      <div class="mb-3">-->
          <!--                          <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>-->
          <!--                          <div class="input-group transparent-append">-->
										<!--<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>-->
          <!--                              <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="dlab-password" placeholder="Enter Your Amount">                                -->
          <!--                          </div>-->
          <!--                          <div class="invalid-feedback amount"></div>-->
          <!--                      </div>-->
                                <button type="submit" class="btn me-2 btn-primary">Upgrade</button>
                            
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
    </div>
        </div>


        @include('users.common.footer')