@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Network</a></li>
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
                    <div class="card-header">
                        <h4 class="card-title">Add Network</h4>
                    </div>
                    @if($data->network == 1 || $data->network == 2 || $data->network == 3 || $data->network == 4)
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('admin.update-network', $data->id)}}" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Network Type<span class="required">*</span></label>
                                    <div class="input-group">
                                <select class="default-select form-control wide border-left-end @error('network') is-invalid @enderror" name="network">
                                    <option selected disabled>Select Network</option>
                                    <option value="1" @if($data->network==1){{'selected'}}@endif>MTN</option>
									<option value="2" @if($data->network==2){{'selected'}}@endif>GOL</option>
									<option value="3" @if($data->network==3){{'selected'}}@endif>AIRTEL</option>
                                    <option value="4" @if($data->network==4){{'selected'}}@endif>9MOBILE</option>
								      </select>     
                                        
                                        @error('network')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Network Plans <span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <select class="default-select form-control wide border-left-end @error('datatype') is-invalid @enderror" name="data_type">
									<option selected disabled>Select Data Type</option>
									<option value="1" @if($data->data_type==1){{'selected'}}@endif>SME</option>
									<option value="2" @if($data->data_type==2){{'selected'}}@endif>CG_LITE</option>
                                    <option value="3" @if($data->data_type==3){{'selected'}}@endif>GIFTING</option>
                                    <option value="4" @if($data->data_type==4){{'selected'}}@endif>DIRECT</option>
								      </select> 
                                                @error('datatype')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Variation Code<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="text" class="form-control  border-left-end @error('variation_code')  is-invalid @enderror" placeholder="Enter Variation Code" name="variation_code" value="{{$data->var_code}}">
                                                @error('variation_code')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Amount<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="text" class="form-control  border-left-end @error('amount')  is-invalid @enderror" placeholder="Enter Amount" name="amount" value="{{$data->amount}}">
                                                @error('amount')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Network Plans <span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <textarea class="form-control" rows="7" id="comment" name="plan">{{$data->plans}}</textarea>
                                            @error('plan')
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
        @endif

        @if($data->network == 5 || $data->network == 6)

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
                    <div class="card-header">
                        <h4 class="card-title">Add Smile & Spectranet</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Network <span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <select class="default-select form-control wide border-left-end @error('datatype') is-invalid @enderror" name="network">
									<option selected disabled>Select Network</option>
									<option value="5">Smile</option>
									<option value="6">Spectratnet</option>
                                    
								      </select> 
                                                @error('datatype')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Network Plans<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <textarea class="form-control" rows="7" id="comment" name="bundle"></textarea>
                                            @error('bundle')
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
        @endif
    </div>
        </div>
       






@include('admin.common.footer')