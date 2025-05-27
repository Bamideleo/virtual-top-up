@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Payment Gateway</a></li>
			</ol>
        </div>
        <!-- row -->
        <div class="row">
        <div class="col-lg-12">
                <div class="card">
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
                    <!-- <div class="card-header">
                        <h4 class="card-title">Paystack Gateway</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('admin.payment-api')}}" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf

                                <input type="hidden" name="type" value="paystack">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Public Key<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($api))
                                    <input type="text" class="form-control @error('public_key')  is-invalid @enderror"  name="public_key" placeholder="Enter Your Public Key">
                                    @else
                                    <input type="text" class="form-control @error('public_key')  is-invalid @enderror" value="{{$api->public_key}}" name="public_key" placeholder="Enter Your Public Key">
                                    @endif  
                                        @error('public_key')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Secret Key<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($api))
                                        <input type="text" class="form-control @error('secret_key')  is-invalid @enderror"  name="secret_key" placeholder="Enter Your Secret Key">
                                        @else
                                    <input type="text" class="form-control @error('secret_key')  is-invalid @enderror" value="{{$api->secret_key}}" name="secret_key" placeholder="Enter Your Secret Key">
                                    @endif
                                    @error('secret_key')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                               
                                <button type="submit" class="btn me-2 btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
            
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Vpay Gateway</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('admin.payment-api')}}" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                                <input type="hidden" name="type" value="vpay">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Public Key<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($api_vpay))
                                    <input type="text" class="form-control @error('public_key')  is-invalid @enderror"  name="public_key" placeholder="Enter Your Public Key">
                                    @else
                                    <input type="text" class="form-control @error('public_key')  is-invalid @enderror" value="{{$api_vpay->public_key}}" name="public_key" placeholder="Enter Your Public Key">
                                    @endif  
                                        @error('public_key')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>

                                    <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Username<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($api_vpay))
                                    <input type="text" class="form-control @error('email')  is-invalid @enderror"  name="email" placeholder="Enter Your Email">
                                    @else
                                    <input type="text" class="form-control @error('email')  is-invalid @enderror" value="{{$api_vpay->email}}" name="email" placeholder="Enter Your Email">
                                    @endif  
                                        @error('email')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>

                                    <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Password<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($api_vpay))
                                    <input type="password" class="form-control @error('password')  is-invalid @enderror"  name="password" placeholder="Enter Your Password">
                                    @else
                                    <input type="password" class="form-control @error('password')  is-invalid @enderror" value="{{$api_vpay->password}}" name="password" placeholder="Enter Your Password">
                                    @endif  
                                        @error('password')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>                               
                                <button type="submit" class="btn me-2 btn-primary">Save</button>
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
       






@include('admin.common.footer')