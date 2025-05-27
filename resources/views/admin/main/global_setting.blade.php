@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Global Setting</a></li>
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
                        <h4 class="card-title">Global Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('admin.save-global-settings')}}" method="post" class="form-valide-with-icon needs-validation" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Site Name<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($g_setting))
                                    <input type="text" class="form-control @error('site_name')  is-invalid @enderror" value="{{ old('site_name') }}" name="site_name" placeholder="Enter Your Site Name">
                                    @else
                                    <input type="text" class="form-control @error('site_name')  is-invalid @enderror" value="{{$g_setting->site_name}}" name="site_name" placeholder="Enter Your Site Name">
                                    @endif  
                                        @error('site_name')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Site Logo<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($g_setting))
                                    <input type="file" class="form-control @error('site_logo')  is-invalid @enderror" value="{{ old('site_logo') }}"  name="site_logo" placeholder="Enter Your Site Logo">
                                    @else
                                    <input type="file" class="form-control @error('site_logo')  is-invalid @enderror" value="{{$g_setting->site_logo}}" name="site_logo" placeholder="Enter Your Site Logo">
                                    @endif  
                                        @error('site_logo')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                   <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Phone Number<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($g_setting))
                                    <input type="text" class="form-control @error('phone_number')  is-invalid @enderror" value="{{ old('phone_number') }}"  name="phone_number" placeholder="Enter Your Site Phone Number">
                                    @else
                                    <input type="text" class="form-control @error('phone_number')  is-invalid @enderror" value="{{$g_setting->phone_number}}" name="phone_number" placeholder="Enter Your Site Phone Number">
                                    @endif  
                                        @error('phone_number')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                    <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Email<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($g_setting))
                                    <input type="email" class="form-control @error('email')  is-invalid @enderror" value="{{ old('email') }}"  name="email" placeholder="Enter Your Site Email">
                                    @else
                                    <input type="email" class="form-control @error('email')  is-invalid @enderror" value="{{$g_setting->email}}" name="email" placeholder="Enter Your Site Email">
                                    @endif  
                                        @error('email')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Site Description<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($g_setting))
                                        <textarea name="description"  cols="30" rows="10" value="{{ old('description') }}" class="form-control @error('description')  is-invalid @enderror"  name="description" placeholder="Enter Your Site Description"></textarea>
                                        @else
                                     <textarea name="description"  cols="30" rows="10" class="form-control @error('description')  is-invalid @enderror"  name="description" placeholder="Enter Your Site Description">{{$g_setting->description}}</textarea>
                                        @endif
                                    @error('description')
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
       






@include('admin.common.footer')