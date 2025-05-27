@extends('authlayout')
@section('content')
<div class="authincation h-100" style="background:#fff">
        <div class="container-fluid h-100">
                <div class="row h-100">
		<div class="col-lg-12 col-md-12 col-sm-12 mx-auto align-self-center">
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
			<div class="login-form">
				<div class="text-center">
					<p>Sign in to your account</p>
				</div>
				<form action="{{ route('login') }}" method="post">
                @csrf
					<div class="mb-4">
						<label class="mb-1 text-dark">Email</label>
						<input type="email" placeholder="Enter Your Email"  class="form-control form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
					<div class="mb-4 position-relative">
						<label class="mb-1 text-dark">Password</label>
						<input type="password" id="dlab-password" placeholder="Enter Your Password" class="form-control form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
						<span class="show-pass eye">
						
							<i class="fa fa-eye-slash"></i>
							<i class="fa fa-eye"></i>
						
						</span>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
					<div class="form-row d-flex justify-content-between mt-4 mb-2">
						<div class="mb-4">
							<div class="form-check custom-checkbox mb-3">
								<input type="checkbox" class="form-check-input" id="customCheckBox1" required="" {{ old('remember') ? 'checked' : '' }}>
								<label class="form-check-label mt-1" for="customCheckBox1">Remember my preference</label>
							</div>
						</div>
						<div class="mb-4">
							<a href="{{ route('password.request') }}" class="btn-link text-primary">Forgot Password?</a>
						</div>
					</div>
					<div class="text-center mb-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
				
					<!-- <div class="mb-3">
						<ul class="d-flex align-self-center justify-content-center">
							<li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
							<li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
							<li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
							<li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
						</ul>
					</div> -->
					<p class="text-center">Not registered?  
						<a class="btn-link text-primary" href="{{route('register')}}">Register</a>
					</p>
				</form>
			</div>
		</div>
       
    </div>
        </div>
    </div>

@endsection