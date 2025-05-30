@extends('authlayout')
@section('content')

<div class="authincation h-100">
        <div class="container-fluid h-100">
                <div class="row h-100">
		<div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
			<div class="login-form">
				<div class="text-center">
					<h3 class="title">Sign up your account</h3>
					<p>Sign in to your account to start using Dompact</p>
				</div>
				<form action="https://dompet.dexignlab.com/laravel/demo/index">
					<div class="mb-4">
						<label class="mb-1 text-dark">Username</label>
						<input type="text" class="form-control form-control" value="username">
					</div>
					<div class="mb-4">
						<label class="mb-1 text-dark">Email</label>
						<input type="email" class="form-control form-control" value="hello@example.com">
					</div>
					<div class="mb-4 position-relative">
						<label class="mb-1 text-dark">Password</label>
						<input type="password"id="dlab-password" class="form-control form-control" value="Password">
						<span class="show-pass eye">
						
							<i class="fa fa-eye-slash"></i>
							<i class="fa fa-eye"></i>
						
						</span>
					</div>
					<div class="form-row d-flex justify-content-between mt-4 mb-2">
						<div class="mb-4">
							<div class="form-check custom-checkbox mb-3">
								<input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
								<label class="form-check-label mt-1" for="customCheckBox1">Remember my preference</label>
							</div>
						</div>
						<div class="mb-4">
							<a href="page-forgot-password.html" class="btn-link text-primary">Sign in</a>
						</div>
					</div>
					<div class="text-center mb-4">
						<button type="submit" class="btn btn-primary btn-block">Sign Up</button>
					</div>
					<h6 class="login-title"><span>Or continue with</span></h6>
					
					<div class="mb-3">
						<ul class="d-flex align-self-center justify-content-center">
							<li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
							<li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
							<li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
							<li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
						</ul>
					</div>
					<p class="text-center">Not registered?  
						<a class="btn-link text-primary" href="page-register.html">Register</a>
					</p>
				</form>
			</div>
		</div>
        <div class="col-xl-6 col-lg-6">
			<div class="pages-left h-100">
				<div class="login-content">
					<a href="index.html"><img src="public/images/logo-full.png" class="mb-3" alt=""></a>
					
					<p>Your true value is determined by how much more you give in value than you take in payment. ...</p>
				</div>
				<div class="login-media text-center">
					<img src="public/images/login.png" alt="">
				</div>
			</div>
        </div>
    </div>
        </div>
    </div>

@endsection