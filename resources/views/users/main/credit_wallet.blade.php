@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Credit Wallet</li>
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
                      <h4 class="card-title">INSTANT WALLET FUNDING</h4>
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
                    <div class="mb-3 blocks">
                         <div class="block__item"></div>
                    <a href="javascript:void(0);"><img style="width:50px; height:50px;" id="data-mtn-1" class="block pay" src="https://www.vpay.africa/static/media/vpayLogo.91e11322.svg" alt="facebook-circled"/></a>
                    <div class="block__item"></div>
                      <img class="block data" id="data-gol" title="Transfer Money" width="94" height="94" src="https://img.icons8.com/3d-fluency/94/money-transfer.png" alt="money-transfer"/>
                    <div class="block__item"></div>
                    <!--<img  class="block data" id="data-mtn" style="width:100px; height:100px;" src="{{asset('assets_1/images/paystack.png')}}" alt="facebook-circled"/>-->
                    <div class="block__item"></div>
                  
                </div>
                <!-- MTN Section -->
                  <div class="row">
                    <div class="col-md-12"  id="vpay">
                    <img  class="block data pay"  style="width:100px; height:100px;" src="https://app.epins.com.ng/uploads/notify/28102023033544vpay.862b3740.svg" alt="facebook-circled"/>
                    <h2><b>Account Number: {{Auth::user()->account_number_1}}</b></h2>
                    <h4><b>Bank Name: {{Auth::user()->bank_name_1}}</b></h4>
                    <h4><b>Account Name: Oluwaseun Bamidele-Boltware</b></h4>
                    <h5>Make transfer to this account to credit your wallet instantly</h5>
                    <h5>₦0 CHARGE</h5> 
                    <h5>PS: Zero charge applies to funding above ₦10,000, below has ₦50 bank charges.</h5>
                    </div>
                    <form action="{{route('paystack')}}" method="post" class="form-valide-with-icon needs-validation" id="paystack" style="display:none">
                        <h4 class="text-center">Pay With Paystack</h4>
                        @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
										@if(!empty($charges))
                                        <input type="hidden" id="paystack-rate" value="{{$charges->code}}">
                                        @endif
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
                       
                            <div class="row" id="tran-money" style="display:none">
                            <div class="col-md-6">
                            <div >
                            <h4>Make a bank deposit or transfer into our corporate account</h4>
                          <h4><b>Bank Name: Opay</b></h4>
                          <h4><b>Account Name:Oluwaseun Olatunde</b></h4>
                           <h4><b>Account No: 611-875-4230</b></h4>
                            <h5 style="color:red;">Note - Pls send your payment screenshot to our Cheif Customer Support via WhatsApp(08136070395)</h5>
                            </div> 
                                </div>
                            <div class="col-md-6">   
                <form class="form-valide-with-icon needs-validation" id="paystack-ii" style="display:none">
                    @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Reference Name<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
										<input type="hidden" value="{{Auth::user()->first_name}}  {{Auth::user()->last_name}}" name="reference_name">
                                        <input type="text" class="form-control border-left-end @error('reference_name') is-invalid @enderror"  value="{{Auth::user()->first_name}}  {{Auth::user()->last_name}}" id="dlab-password" placeholder="Enter Your Reference Name" disabled>          
                                    </div>
                                    <div class="invalid-feedback reference_name"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="dlab-password" placeholder="Enter Your Amount">                                
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>
                                <button type="submit" class="btn me-2 btn-primary" id="submit-paystack">Submit</button>
                                <button class="btn btn-primary" type="button" disabled style="display:none" id="submit-paystack-1">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Submiting....</span></button>
                            </form>
                            <br>
        <h6 style="color:red;">Your account will be suspend ,if you submit without transfer.</h6>
<h6 style="color:red;">Please note that on every wallet top up less than &#8358;4,999 normal charges apply but there is a charge of &#8358;50 if the amount greater than &#8358;4,999.</h6>


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
        
        
          @if(empty(Auth::user()->account_number_1))
        <input type="hidden" value="1" id="v-pay">
        @endif
        
          <div class="modal fade" id="exampleModalCenter">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div>
                                                <img  class="block"  style="width:150px; height:150px;" src="https://app.epins.com.ng/uploads/notify/28102023033544vpay.862b3740.svg" alt="facebook-circled"/>
                                            </div>
                                            <h3 style="text-align:center">Zero Charges Offer</h3>
                                            <p style="text-align:center">Fund your waveplus Account instantly with VPay at zero charges. Enter Phone Number and click on generate account button now to enjoy!</p>
                                        <form action="{{route('vpay')}}" method="post" class="form-valide-with-icon needs-validation" id="vpay-acct">
                                             @csrf
                                         <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_number') is-invalid @enderror" id="paystack-pay" value="{{ old('phone_number') }}"  name="phone_number" placeholder="Enter Your Phone Numnber">
                                    </div>  
                                        </div>
                                        <div class="modal-footer">
                                            <!--<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>-->
                                            <button type="submit" class="btn btn-primary" id="gen-1">Generate Account!</button>
                                        </div>
                                             <button class="btn btn-warning" type="button" disabled style="display:none" id="gen-data">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Generating....</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>



        @include('users.common.footer')