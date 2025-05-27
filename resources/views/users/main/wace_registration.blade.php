@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">WACE PINS</li>
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
                    <img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/facebook-circled.png" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/instagram-new.png" alt="instagram-new"/>
                    <div class="block__item"></div>
                    <img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/twitter-circled.png" alt="twitter-circled"/>
                    <div class="block__item"></div>
                    <img style="width:35px; height:35px;" class="block" src="https://img.icons8.com/3d-fluency/94/linkedin.png" alt="linkedin"/>
                    <div class="block__item"></div>
                </div>
                    </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Choose Your Prefer Service</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-mtn" height="50" src="{{asset('assets_1/images/wace.webp')}}" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-gol" height="50" src="{{asset('assets_1/images/wace-1.webp')}}" alt="instagram-new"/>
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
                <!-- MTN Section -->
                    <form class="form-valide-with-icon needs-validation" id="exam-pin">
                    <h4 class="text-center">WAEC Registration</h4>
                    @csrf
                    <input type="hidden" value="waec-registration" name="service">
                    <input type="hidden" value="waec-registraion" name="service_id">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="hidden" name="wea_amount" value="14450" id="wea-amount">
                                        <input type="hidden" name="t_amount" id="t-amount">
                                        <input type="number" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="ex-phone" placeholder="Enter Your Mobile Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="amount" disabled>
									</div>
                                    <!-- <div class="invalid-feedback phone_number"></div> -->

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-exam-rg">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-exam-rg-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>


                            <!-- Gol Section -->
                    <form  class="form-valide-with-icon needs-validation" id="exam-pin-1" style="display:none;">
                    <h4 class="text-center">WAEC Result Checker</h4>
                    @csrf
                    <input type="hidden" value="waecdirect" name="service">
                    <input type="hidden" value="waec" name="service_id">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Mobile Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="hidden" name="wea_amount" value="900" id="wea-amount-1">
                                        <input type="hidden" name="t_amount" id="t-amount-1">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="re-phone" placeholder="Enter Your Mobile Number">         
                                    </div>
                                    <div class="invalid-feedback phone_number"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="amount-1" disabled>
									</div>
                                    <!-- <div class="invalid-feedback phone_number"></div> -->

                                </div>
                                <button type="submit" class="btn me-2 btn-whatsapp" id="submit-exam-r">Proceed</button>
<button class="btn btn-success" type="button" disabled style="display:none" id="submit-exam-r-i">
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