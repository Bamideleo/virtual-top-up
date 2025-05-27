@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Share Wallet</li>
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
                      <h4 class="card-title">Share Wallet With Other Users</h4>
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
            
                </div>
                <!-- MTN Section -->
                    <form action="{{route('share.balance')}}" method="post" class="form-valide-with-icon needs-validation" id="paystack">
                        
                        @csrf
                        <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Email<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="email" class="form-control border-left-end @error('email') is-invalid @enderror"  value="{{ old('email') }}"  name="email" placeholder="Enter Receiver Email">
                                        @error('email')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                   
                        </div>    
                        <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
										@if(!empty($charges))
                                        <input type="hidden" id="paystack-rate" value="{{$charges->code}}">
                                        <input type="hidden" id="total-amount" name="t_amount">
                                        @endif
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
                          <h4><b>Account Name: WavePlus</b></h4>
                          <h4><b>Account Name: Opay</b></h4>
                           <h4><b>Account No: 345656723487</b></h4>
                            <h5 style="color:red;">Note - Pls send your payment screenshot to our Cheif Customer Support via WhatsApp(08085724009)</h5>
                            </div> 
                                </div>
                            <div class="col-md-6">   
                <form class="form-valide-with-icon needs-validation" id="paystack-ii">
                    @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Reference Name<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('reference_name') is-invalid @enderror" name="reference_name" value="{{ old('reference_name') }}" id="dlab-password" placeholder="Enter Your Reference Name">          
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
        <h6 style="color:red">Your account will be suspend ,if you submit without transfer.</h6>

<h6 style="color:red">Please note that there is a charge of &#8358;50 if the amount greater than &#8358;4,999.</h6>


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