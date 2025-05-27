@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Create User</a></li>
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
                        <h4 class="card-title">Add New User</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" method="post" action="{{route('admin.save-user')}}" id="my-user">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01">Firstname
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
												<input type="text" value="{{ old('firstname') }}" class="form-control @error('firstname') is-invalid @enderror" id="validationCustom01" name="firstname" placeholder="Enter your firstname" >
                                                @error('firstname')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom02">Lastname <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" value="{{ old('lastname') }}" class="form-control @error('lastname') is-invalid @enderror" id="validationCustom02" name="lastname" placeholder="Enter your lastname..">
												@error('lastname')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom03">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="validationCustom03" name="email" placeholder="Your vaild email">
												@error('email')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom04">Phone Number <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                            <input type="text" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" id="validationCustom02" name="phone_number" placeholder="Enter your phone number..">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                     
                                    
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="validationCustom11" name="password" placeholder="Enter Your password">
												@error('password')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                            </div>
                                        </div>
                                     
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
        </div>
       






@include('admin.common.footer')