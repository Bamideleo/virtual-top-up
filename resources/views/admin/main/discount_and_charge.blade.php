@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Create Discount or Charges</a></li>
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
                        <ul>
                            @if(!empty($coupon))
                            <li style="font-size:18px;color:#000;">Discount Code: {{$coupon->code}}</li>
                            @endif
                            @if(!empty($airtime))
                            <li style="font-size:18px;color:#000;">Percentage Charge on airtime: {{$airtime->code}}%</li>
                            @endif
                            @if(!empty($unility))
                            <li style="font-size:18px;color:#000;">Percentage Charge on utilities: {{$unility->code}}%</li>
                            @endif
                            @if(!empty($payment))
                            <li style="font-size:18px;color:#000;">Percentage Charge on payment: {{$payment->code}}</li>
                            @endif
                             @if(!empty($data))
                            <li style="font-size:18px;color:#000;">Percentage Charge on Data: {{$data->code}}%</li>
                            @endif
                             @if(!empty($agent))
                            <li style="font-size:18px;color:#000;">Percentage Charge on Agent: {{$agent->code}}%</li>
                            @endif
                             @if(!empty($vendor))
                            <li style="font-size:18px;color:#000;">Percentage Charge on Vendor: {{$vendor->code}}%</li>
                            @endif
                            @if(!empty($cashback))
                            <li style="font-size:18px;color:#000;">Percentage Charge on Cashback: {{$cashback->code}}%</li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                        <button type="button" class="btn me-2 btn-primary" id="code-generator" style="float:right;">Generate Coupon Code</button>
                        <br><br>
                            <form action="{{route('admin.save-charges')}}" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Discount / Charges<span class="required">*</span></label>
                                    <div class="input-group">
                                <select class="default-select form-control wide border-left-end @error('discount')  is-invalid @enderror" value="{{ old('discount') }}" name="discount">
                                    <option selected disabled>Select Network</option>
                                    <option value="1">Coupon Code</option>
									<option value="4">Airtime</option>
									<option value="3">Payment</option>
                                    <option value="2">Utilities</option>
                                    <option value="5">Data</option>
                                    <option value="6">Agent</option>
                                     <option value="7">Vendor</option>
                                      <option value="8">Cashback</option>
								      </select>     
                                        
                                        @error('network')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Charges & Code<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                    <input type="text" class="form-control @error('code')  is-invalid @enderror"  name="code" id="code">
                                                @error('code')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Coupon Discount</label>
                                    <div class="input-group transparent-append">
                                    <input type="number"  class="form-control @error('code')  is-invalid @enderror"  name="coupon_amt" id="code">
                                                @error('code')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">End Date</label>
                                    <div class="input-group transparent-append">
                                    <input type="date" min="2014-01-01" max="2050-12-31" class="form-control @error('code')  is-invalid @enderror"  name="expire_at" id="code">
                                                @error('code')
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
           
            <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>Discount</strong></th>
										<th class="text-end"><strong>Action</strong></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                @forelse ($get_all as $user) 
                                    <tr>
                                        <td><strong>{{$i}}</strong></td>
                                        @if($user->discount == 1)
                                        <td>Coupon Code</td>
                                        @endif
                                        @if($user->discount == 2)
                                        <td>utilities</td>
                                        @endif
                                        @if($user->discount == 3)
                                        <td>Payment</td>
                                        @endif
                                        @if($user->discount == 4)
                                        <td>Airtime</td>
                                        @endif
                                         @if($user->discount == 5)
                                        <td>Data</td>
                                        @endif
                                         @if($user->discount == 6)
                                        <td>Agent</td>
                                        @endif
                                         @if($user->discount == 7)
                                        <td>Vendor</td>
                                        @endif
                                        @if($user->discount == 8)
                                        <td>Cashback</td>
                                        @endif
                                        <td><a href="{{route('admin.delete-discount',$user->id)}}">Delete</a></td>
                                       
                                        
											</div>
										</td>
                                    </tr>
                                  

                                    @php
                                    $i++;
                                    @endphp
                                    @empty
                                        <p>No Record</p>
                                    @endforelse
                                </tbody>
                            </table>
                           
                           
                        </div>
                    </div>
       
           
          
        </div>


        
    </div>
        </div>
       






@include('admin.common.footer')