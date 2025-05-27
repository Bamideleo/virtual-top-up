@extends('authlayout')
@section('content')
<div class="authincation h-100">
        <div class="container-fluid h-100">
                <div class="row h-100">
		<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
			<div class="login-form">
				<div class="text-center">
					<h3 class="title">Reset Your Password</h3>
				</div>
				 @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
				<form action="{{ route('password.email') }}" method="post">
                @csrf
					<div class="mb-4">
						<label class="mb-1 text-dark">Email Address</label>
						<input type="email" placeholder="Enter Email Address" class="form-control form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
					<div class="text-center mb-4">
						<button type="submit" class="btn btn-primary btn-block">Reset Password</button>
					</div>
				
					<!-- <div class="mb-3">
						<ul class="d-flex align-self-center justify-content-center">
							<li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
							<li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
							<li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
							<li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
						</ul>
					</div> -->
					<p class="text-center">Back to Login  
						<a class="btn-link text-primary" href="{{route('login')}}">Login</a>
					</p>
				</form>
			</div>
		</div>
        <div class="col-xl-6 col-lg-6">
			<div class="pages-left h-100">
				<div class="login-content">
					<a href="index.html"><img src="{{asset('public/images/logo-full.png')}}" class="mb-3" alt=""></a>
					
					<p>Your true value is determined by how much more you give in value than you take in payment. ...</p>
				</div>
				<div class="login-media text-center">
					<img src="{{asset('public/images/login.png')}}" alt="">
				</div>
			</div>
        </div>
    </div>
        </div>
    </div>

@endsection