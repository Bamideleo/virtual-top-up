@extends('authlayout')
@section('content')
<div class="authincation h-100" style="background:#fff">
        <div class="container-fluid h-100">
                <div class="row h-100">
		<div class="col-lg-12 col-md-12 col-sm-12 mx-auto align-self-center">
			<div class="login-form">
				<div class="text-center">	
				</div>
				<form action="{{route('cretae-user')}}" method="post">
                @csrf
                    <div class="mb-4">
						<label class="mb-1 text-dark">First Name</label>
						<input type="text" placeholder="Enter Your First Name"  class="form-control form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">
                        @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="mb-4">
						<label class="mb-1 text-dark">Last Name</label>
						<input type="text" placeholder="Enter Your Last Name"  class="form-control form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="mb-4">
						<label class="mb-1 text-dark">Email</label>
						<input type="email" placeholder="Enter Your Email"  class="form-control form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

					<div class="mb-4">
						<label class="mb-1 text-dark">Phone Number</label>
						<input type="number" placeholder="Enter Your Phone Number"  class="form-control form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}">
                        @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
    
					<div class="mb-4 position-relative">
						<label class="mb-1 text-dark">Password</label>
						<input type="password" id="dlab-password" placeholder="Enter Your Password" class="form-control form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
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
				
                    
					<div class="mb-4 position-relative">
						<label class="mb-1 text-dark">Confirm Password</label>
						<input type="password" id="dlab-password" placeholder="Enter Your Confirm Password" class="form-control form-control" name="password_confirmation"  autocomplete="current-password">
						<span class="show-pass eye">
						
							<i class="fa fa-eye-slash"></i>
							<i class="fa fa-eye"></i>
						
						</span>

					</div>
					<div class="text-center mb-4">
						<button type="submit" class="btn btn-primary btn-block">Sign Up</button>
					</div>
				
					<!-- <div class="mb-3">
						<ul class="d-flex align-self-center justify-content-center">
							<li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
							<li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
							<li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
							<li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
						</ul>
					</div> -->
					<p class="text-center">Back Login?  
						<a class="btn-link text-primary" href="{{route('login')}}">Login</a>
					</p>
				</form>
			</div>
		</div>
       
    </div>
        </div>
    </div>

@endsection