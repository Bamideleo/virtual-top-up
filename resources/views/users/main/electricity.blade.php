@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Electricity Payment</li>
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
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                    <div class="mb-3 blocks">
                    @if($electric_bill ==1)
                    <img width="50"  id="data-mtn" height="50" src="{{asset('assets_1/images/ikedc.webp')}}" alt="facebook-circled"/>
                    @endif
                    @if($electric_bill ==2)
                    <img width="50"  id="data-gol" height="50" src="{{asset('assets_1/images/ekedc.jpg')}}" alt="instagram-new"/>
                    @endif
                    @if($electric_bill ==3)
                    <img width="hidden"  id="data-airtel" height="50" src="{{asset('assets_1/images/kedco.png')}}" alt="twitter-circled"/>
                    @endif
                    @if($electric_bill ==4)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/phed.png')}}" alt="linkedin"/>
                    @endif
                    @if($electric_bill ==5)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/jedc.jpg')}}" alt="linkedin"/>
                    @endif
                    @if($electric_bill ==6)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/ibedc.png')}}" alt="linkedin"/>
                    @endif
                    @if($electric_bill ==7)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/kaedco.jpeg')}}" alt="linkedin"/>
                    @endif
                    @if($electric_bill ==8)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/aedc.jpg')}}" alt="linkedin"/>
                    @endif
                    @if($electric_bill ==9)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/bedc.jpg')}}" alt="linkedin"/>
                    @endif
                    @if($electric_bill ==10)
                    <img width="50"  id="data-nine" height="50" src="{{asset('assets_1/images/eedc.webp')}}" alt="linkedin"/>
                    @endif

                  
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
                               
                    <!-- <div class="block__item"></div>          -->
                </div>
                <!-- MTN Section -->
                @if($electric_bill ==1)
                    <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Ikeja Electricity Distribution(IKEDC)</h4>
                    @csrf
                    <!-- <input type="hidden" value="1" name="type"> -->
                    <input type="hidden"  name="service" value="ikeja-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="1" name="type">
                    <input type="hidden"  name="service" value="ikeja-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif

                            <!-- Gol Section -->
            @if($electric_bill == 2)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Eko Electricity Distribution Company(EKEDC)</h4>
                    @csrf
                    <!-- <input type="hidden" value="2" name="type"> -->
                    <input type="hidden"  name="service" value="eko-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="2" name="type">
                    <input type="hidden"  name="service" value="eko-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif

                                    <!-- Airtel Section -->

                                    @if($electric_bill == 3)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Kano Electricity Distribution Company(KEDCO)</h4>
                    @csrf
                    <!-- <input type="hidden" value="2" name="type"> -->
                    <input type="hidden"  name="service" value="eko-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="3" name="type">
                    <input type="hidden"  name="service" value="kano-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif




                             <!-- 9mobile Section -->

                             @if($electric_bill == 4)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Port Harcourt Electricity Distribution Company(PHED)</h4>
                    @csrf
                    <input type="hidden" value="4" name="type">
                    <input type="hidden"  name="service" value="portharcourt-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="4" name="type">
                    <input type="hidden"  name="service" value="portharcourt-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif


                        <!-- Jos -->



                        @if($electric_bill == 5)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Joss’s Electricity Distribution Company(JED)</h4>
                    @csrf
                    <input type="hidden" value="4" name="type">
                    <input type="hidden"  name="service" value="jos-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="5" name="type">
                    <input type="hidden"  name="service" value="jos-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif



                    @if($electric_bill == 6)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Ibadan Electricity Distribution Company(IBEDC)</h4>
                    @csrf
                    <input type="hidden" value="4" name="type">
                    <input type="hidden"  name="service" value="ibadan-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="5" name="type">
                    <input type="hidden"  name="service" value="ibadan-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif



                    
                    @if($electric_bill == 7)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Kaduna Electric Distribution Company(KAEDC)</h4>
                    @csrf
                    <!-- <input type="hidden" value="4" name="type"> -->
                    <input type="hidden"  name="service" value="kaduna-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="7" name="type">
                    <input type="hidden"  name="service" value="kaduna-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif



                    @if($electric_bill == 8)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Abuja Electricity Distribution Company(AEDC)</h4>
                    @csrf
                    <input type="hidden" value="4" name="type">
                    <input type="hidden"  name="service" value="abuja-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="8" name="type">
                    <input type="hidden"  name="service" value="abuja-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif




                    @if($electric_bill == 9)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Benin Electricity Distribution Company (BEDC)</h4>
                    @csrf
                    <!-- <input type="hidden" value="9" name="type"> -->
                    <input type="hidden"  name="service" value="benin-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="9" name="type">
                    <input type="hidden"  name="service" value="benin-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number"  id="meter-number">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif





                    @if($electric_bill == 10)
                            <form class="form-valide-with-icon needs-validation" id="eko-1">
                    <h4 class="text-center">Enugu Electric Distribution Company (EEDC)</h4>
                    @csrf
                    <input type="hidden" value="10" name="type">
                    <input type="hidden"  name="service" value="enugu-electric">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Meter Type<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                    <select id="meter-type" class="default-select form-control wide border-left-end" name="meter_type">
									<option selected disabled>Select Meter Type</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback meter_type"></div>
                                </div>
    
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="meter_number"  id="dlab-password" placeholder="Enter Your Meter Number">
									</div>
                                    <div class="invalid-feedback meter_number"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-eko-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-eko-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                    <form  class="form-valide-with-icon needs-validation" id="eko-2" style="display:none">
                    <h4 class="text-center">Username: <span id='username'></span></h4>
                    <h4 class="text-center">Address: <span id='address'></span></h4>
                        <h4 class="text-center">Account Verified</h4>
                    @csrf
                    <input type="hidden" value="10" name="type">
                    <input type="hidden"  name="service" value="enugu-electric">

                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Type<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden"  name="meter_type"  id="met-type">
                                        <input type="text" class="form-control border-left-end" name="m_type"  id="m-type" disabled>
									</div>
                                    <div class="invalid-feedback meter_type"></div>

                                </div>
                            
                    <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Meter Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-credit-card"></i> </span>
                                        <input type="hidden" class="form-control border-left-end" name="meter_number" value="1010101010101"  id="meter-num">
                                        <input type="text" class="form-control border-left-end" name="m_number"  id="m-number" disabled>
									</div>
                                    <div class="invalid-feedback m_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Phone Number<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" id="dlab-password" placeholder="Enter Your Phone Number">
									</div>
                                    <div class="invalid-feedback phone_number"></div>

                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('amount') is-invalid @enderror" name="ts_amount" value="{{ old('amount') }}" id="ts-amount" placeholder="Enter Your Amount">
									</div>
                                    <div class="invalid-feedback amount"></div>

                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount To Pay<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="hidden" name="amount" id="amount">
										<span class="input-group-text"> <i class="fa fa-naira-sign"></i> </span>
                                        <input type="text" class="form-control border-left-end" name="t_amount"  id="t-amount" disabled>
									</div>
                                    <div class="invalid-feedback"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-ek">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-ek-i">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>
                    @endif





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