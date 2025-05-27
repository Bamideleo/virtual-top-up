@include('admin.common.header')

        <div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">SMTP Settings</a></li>
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
                        <h4 class="card-title">Setup SMTP Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('admin.connect-email')}}" method="post" class="form-valide-with-icon needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="type" value="vtpass">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">SMTP Host<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($data))
                                    <input type="text" class="form-control @error('host')  is-invalid @enderror"  name="host" placeholder="Enter Your Host">
                                    @else
                                    <input type="text" class="form-control @error('host')  is-invalid @enderror" value="{{$data->host}}" name="host" placeholder="Enter Your Host">
                                    @endif  
                                        @error('host')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">SMTP Port<span class="required">*</span></label>
                                    <div class="input-group">
                                    @if(empty($data))
                                    <input type="text" class="form-control @error('port')  is-invalid @enderror"  name="port" placeholder="Enter Your Port">
                                    @else
                                    <input type="text" class="form-control @error('port')  is-invalid @enderror" value="{{$data->port}}" name="port" placeholder="Enter Your Port">
                                    @endif  
                                        @error('port')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">SMTP Username<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($data))
                                        <input type="text" class="form-control @error('username')  is-invalid @enderror"  name="username" placeholder="e.g support@boltware.com">
                                        @else
                                    <input type="text" class="form-control @error('username')  is-invalid @enderror" value="{{$data->username}}" name="username" placeholder="e.g support@boltware.com">
                                    @endif
                                    @error('username')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>
                               
                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">SMTP Password<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($data))
                                        <input type="password" class="form-control @error('password')  is-invalid @enderror"  name="password" placeholder="Enter Your Password">
                                        @else
                                    <input type="password" class="form-control @error('password')  is-invalid @enderror" value="{{$data->password}}" name="password" placeholder="Enter Your Password">
                                    @endif
                                    @error('password')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Sender Email Address<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($data))
                                        <input type="email" class="form-control @error('email')  is-invalid @enderror"  name="email" placeholder="e.g support@boltware.com">
                                        @else
                                    <input type="email" class="form-control @error('email')  is-invalid @enderror" value="{{$data->email}}" name="email" placeholder="e.g support@boltware.com">
                                    @endif
                                    @error('email')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Sender Name<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($data))
                                        <input type="text" class="form-control @error('sender')  is-invalid @enderror"  name="sender" placeholder="Enter Your Sender">
                                        @else
                                    <input type="text" class="form-control @error('sender')  is-invalid @enderror" value="{{$data->sender}}" name="sender" placeholder="Enter Your Sender">
                                    @endif
                                    @error('sender')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">SMTP Encryption<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        @if(empty($data))
                                        <input type="text" class="form-control @error('encryption')  is-invalid @enderror"  name="encryption" placeholder="Enter Your SSL">
                                        @else
                                    <input type="text" class="form-control @error('encryption')  is-invalid @enderror" value="{{$data->encryption}}" name="encryption" placeholder="Enter Your SSL">
                                    @endif
                                    @error('encryption')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn me-2 btn-primary">Save</button>
                            </form>
                            <br> <br>
                            <form action="{{route('admin.test')}}" method="post">
                            <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Testing<span class="required">*</span></label>
                                    <div class="input-group transparent-append">
                                        <input type="text" class="form-control @error('email')  is-invalid @enderror"  name="sender" placeholder="Enter Your Testing Email">
                                    @error('email')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn me-2 btn-primary">Send</button>
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