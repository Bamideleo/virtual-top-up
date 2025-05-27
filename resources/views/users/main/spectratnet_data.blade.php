@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Spectratnet Bundle</li>
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
                      
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    <img class="block data" id="data-mtn" style="width:100px;height:100px;" src="{{asset('assets_1/images/spectratnet.jpeg')}}" alt="facebook-circled"/>
                </div>
                <h6 id="spe-cb-1" style="display:none;color:blue">Cashback: &#8358;<span id="spe-cb"></span></h6>
                <!-- MTN Section -->
                    <form class="form-valide-with-icon needs-validation" id="spectranet-data">
                    @csrf
                    <input type="hidden" name="data_type" value="spectranet">
                                <div class="mb-3">
                     <input type="hidden" id="cash-back" name="cash_back">
                                    <label class="text-label form-label" for="validationCustomUsername">Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select class="default-select form-control wide border-left-end" name="type" id="spec-type">
                                    <option selected disabled>Select Type</option>
								  @foreach($type as $types)
								<option value="{{$types['variation_code']}}" data-id="{{$types['variation_amount']}}">{{$types['name']}}</option>
									@endforeach
								      </select>
                                    </div>
                                    <div class="invalid-feedback type"></div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Plans<span class="required">*</span></label>
                                    <div class="input-group">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select class="default-select form-control wide border-left-end">
									<option>Option 1</option>
									<option>Option 2</option>
									<option>Option 3</option>
								      </select>
										<div class="invalid-feedback">
											Please Enter a username.
										  </div>
                                    </div>
                                </div> -->
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="number" class="form-control border-left-end" name="phone_number" id="dlab-password" placeholder="Enter Your Phone Number">
                                    </div>
                                    <div class="invalid-feedback phone_number"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
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
                <input type="hidden" name="ch-back" id="ch-back" value="{{$cashback->code}}">
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
                                        <input type="hidden" name="t_amount" id="t-amount">
                                        <input type="number" class="form-control border-left-end" id="spec-amount" name="amount" placeholder="Enter Your Amount" disabled>
                                    </div>
                                    <div class="invalid-feedback amount"></div>
                                </div>

                                <button type="submit" class="btn me-2 btn-success" id="submit-spectranet">Proceed</button>
                                <button class="btn btn-success" type="button" disabled style="display:none" id="submit-spectranet-1">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">processing....</span></button>
                            </form>


                            <!-- Gol Section -->

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