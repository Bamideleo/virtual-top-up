@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Create Network</a></li>
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
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('admin.save-network')}}" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Network Type<span class="required">*</span></label>
                                    <div class="input-group">
                                <select class="default-select form-control wide border-left-end @error('network')  is-invalid @enderror" value="{{ old('network') }}" name="network">
                                    <option selected disabled>Select Network</option>
                                    <option value="1">MTN</option>
									<option value="2">GOL</option>
									<option value="3">AIRTEL</option>
                                    <option value="4">9MOBILE</option>
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
                                    <select class="default-select form-control wide border-left-end @error('data_type') is-invalid @enderror" name="data_type" value="{{ old('data_type') }}">
									<option selected disabled>Select Data Type</option>
                                    <option value="1">SME</option>
									<option value="2">CG_LITE</option>
                                    <option value="3">GIFTING</option>
                                    <option value="4">DIRECT</option>
                                    
								      </select> 
                                                @error('data_type')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                               
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Variation Code<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="text" class="form-control  border-left-end @error('variation_code')  is-invalid @enderror" placeholder="Enter Variation Code" name="variation_code">
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
                                    <input type="text" class="form-control  border-left-end @error('amount')  is-invalid @enderror" placeholder="Enter Amount" name="amount">
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
                                    <textarea class="form-control" rows="7" id="comment" name="plan" value="{{ old('plan') }}"></textarea>
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



        <div class="col-lg-12">
                <div class="card">
              
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
                                    <select class="default-select form-control wide border-left-end @error('network') is-invalid @enderror" name="network" value="{{ old('network') }}">
									<option selected disabled>Select Network</option>
									<option value="5">Smile</option>
									<option value="6">Spectratnet</option>
                                    
								      </select> 
                                                @error('network')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Network Plans<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <textarea class="form-control" rows="7" id="comment" name="bundle" value="{{ old('bundle') }}"></textarea>
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


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>Plans</strong></th>
										<th class="text-end"><strong>Action</strong></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                @forelse ($data as $plan) 
                                    <tr>
                                        <td><strong>{{$i}}</strong></td>
                                        <td>{{$plan->plans}}</td>                      
                                        <td class="text-end">
											<div class="dropdown">
												<button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
													<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="{{route('admin.edit-network',$plan->id)}}">Edit</a>
                                                    <a class="dropdown-item" href="{{route('admin.delete-network',$plan->id)}}">Delete</a>
												</div>
											</div>
										</td>
                                    </tr>
                                  

                                    @php
                                    $i++;
                                    @endphp
                                    @empty
                                        <p>No users</p>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $data->links ('vendor.pagination.bootstrap-4') }}
                           
                        </div>
                    </div>
                </div>
            </div>
           
          
        </div>
    </div>
        </div>
       






@include('admin.common.footer')