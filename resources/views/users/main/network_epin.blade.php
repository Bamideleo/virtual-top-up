@include('users.common.header')
<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Network Epin</li>
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
                    <img width="50" class="block data" id="data-mtn" height="50" src="{{asset('assets_1/images/mtn-data.jpg')}}" alt="facebook-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-gol" height="50" src="{{asset('assets_1/images/gol-data.jpg')}}" alt="instagram-new"/>
                    <div class="block__item"></div>
                    <img width="hidden" class="block data" id="data-airtel" height="50" src="{{asset('assets_1/images/airtel.jpg')}}" alt="twitter-circled"/>
                    <div class="block__item"></div>
                    <img width="50" class="block data" id="data-nine" height="50" src="{{asset('assets_1/images/9mobile-data.jpg')}}" alt="linkedin"/>
                    <div class="block__item"></div>         
                </div>
                <!-- MTN Section -->
                    <form class="form-valide-with-icon needs-validation" id="mtn-epin-1">
                    <h4 class="text-center">MTN EPIN</h4>
                    @csrf
                    <input type="hidden" value="epin" id="mtn-data" name="epin">
                    <input type="hidden" value="mtn" name="service">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Denomination<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select id="mtn-type" class="default-select form-control wide border-left-end @error('denomination') is-invalid @enderror" name="denomination" value="{{ old('denomination') }}">
									<option selected disabled>Select Denomination</option>
									<option value="1">100</option>
									<option value="2">200</option>
                                    <option value="4">400</option>
                                    <option value="5">500</option>
                                    <option value="7.5">750</option>
                                    <option value="10">1000</option>
                                    <option value="15">1500</option>
								      </select>           
                                    </div>
                                    <div class="invalid-feedback denomination"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Quantity<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" id="dlab-password" placeholder="Enter Your Quantity">
									</div>
                                    <div class="invalid-feedback quantity"></div>

                                </div>
                                <button type="submit" class="btn me-2 btn-snapchat" id="submit-data-1">Proceed</button>
            <button class="btn btn-warning" type="button" disabled style="display:none" id="submit-data">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>


                            <!-- Gol Section -->

                    <form  action="{{route('waveplus.data')}}" method="post" class="form-valide-with-icon needs-validation" id="epin-gol-1" style="display:none;">
                    <h4 class="text-center">GOL EPIN</h4>
                    @csrf
                    <input type="hidden" value="epin" name="epin">
                    <input type="hidden" value="gol" name="service">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Denomination<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select id="gol-type" class="default-select form-control wide border-left-end @error('denomination') is-invalid @enderror" value="{{ old('denomination') }}" name="denomination">
									<option selected disabled>Select Denomination</option>
									<option value="1">100</option>
									<option value="2">200</option>
                                    <option value="4">400</option>
                                    <option value="5">500</option>
                                    <option value="7.5">750</option>
                                    <option value="10">1000</option>
                                    <option value="15">1500</option>
								      </select>
                                     
                                              
                                    </div>
                                    <div class="invalid-feedback denomination"></div>
                                </div>
                             
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Quantity<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" id="dlab-password" placeholder="Enter Your Mobile Number">
									
                                                
                                               
                                    </div>
                                    <div class="invalid-feedback quantity"></div>
                                </div>
                              
                                <button type="submit" class="btn me-2 btn-whatsapp" id="submit-data-2">Proceed</button>
<button class="btn btn-success" type="button" disabled style="display:none" id="submit-data-ii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>



                                    <!-- Airtel Section -->

  <form action="{{route('waveplus.data')}}" method="post" class="form-valide-with-icon needs-validation" id="epin-airtel-1" style="display:none;">
                    <h4 class="text-center">AIRTEL EPIN</h4>
                    @csrf
                    <input type="hidden" value="epin" name="epin">
                    <input type="hidden" value="airtime" name="service">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Denomination<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select id="airtel-type" class="default-select form-control wide border-left-end @error('denomination') is-invalid @enderror" name="denomination" value="{{ old('denomination') }}">
                                    <option selected disabled>Select Denomination</option>
									<option value="1">100</option>
									<option value="2">200</option>
                                    <option value="4">400</option>
                                    <option value="5">500</option>
                                    <option value="7.5">750</option>
                                    <option value="10">1000</option>
                                    <option value="15">1500</option>
								      </select>
                                     </div>
                                     <div class="invalid-feedback denomination"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Quantity<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="number" class="form-control border-left-end @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" id="dlab-password" placeholder="Enter Your Mobile Number">          
                                    </div>
                                    <div class="invalid-feedback quantity"></div>
                                </div>
                                <button type="submit" class="btn me-2 btn-youtube" id="submit-data-3">Proceed</button>
                                <button class="btn btn-danger" type="button" disabled style="display:none" id="submit-data-iii">
  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
  <span role="status">Processing....</span></button>
                            </form>




                             <!-- 9mobile Section -->

  <form action="{{route('waveplus.data')}}" method="post" class="form-valide-with-icon needs-validation" id="epin-nine-1" style="display:none;">
                    <h4 class="text-center">9MOBILE EPIN</h4>
                    @csrf
                    <input type="hidden" value="epin" name="epin">
                    <input type="hidden" value="etisalat" name="service">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Denomination<span class="required">*</span></label>
                                    <div class="input-group">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select id="nine-type" class="default-select form-control wide border-left-end @error('denomination') is-invalid @enderror" name="denomination" value="{{ old('denomination') }}">
                                    <option selected disabled>Select Denomination</option>
									<option value="1">100</option>
									<option value="2">200</option>
                                    <option value="4">400</option>
                                    <option value="5">500</option>
                                    <option value="7.5">750</option>
                                    <option value="10">1000</option>
                                    <option value="15">1500</option>
								      </select>        
                                    </div>
                                    <div class="invalid-feedback denomination"></div>
                                </div>
                              
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Quantity<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="text" class="form-control border-left-end @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" id="dlab-password" placeholder="Enter Your Mobile Number">
                                    </div>
                                    <div class="invalid-feedback quantity"></div>
                                </div>
                              
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