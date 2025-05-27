@extends('authlayout')
@section('content')
<div class="authincation h-100">
        <div class="container-fluid h-100">
                <div class="row h-100">
		<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
			<div class="login-form">
				<div class="text-center">
					<h3 class="title">Sign In</h3>
					<p>Sign in to your account</p>
				</div>
				<form action="{{ route('admin.login') }}" method="post">
                @csrf
					<div class="mb-4">
						<label class="mb-1 text-dark">Email</label>
						<input type="email" class="form-control form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
					<div class="mb-4 position-relative">
						<label class="mb-1 text-dark">Password</label>
						<input type="password" id="dlab-password" class="form-control form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
								<input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
								<label class="form-check-label mt-1" for="customCheckBox1">Remember my preference</label>
							</div>
						</div>
						<div class="mb-4">
							<a href="{{route('admin.reset-password')}}" class="btn-link text-primary">Forgot Password?</a>
						</div>
					</div>
					<div class="text-center mb-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
				</form>
			</div>
		</div>
        <div class="col-xl-6 col-lg-6">
			<div class="pages-left h-100">
				<div class="login-content">
					<p>Your true value is determined by how much more you give in value than you take in payment. ...</p>
				</div>
				<div class="login-media text-center">
					<img src="{{asset('assets_1/images/login.png')}}" alt="">
				</div>
			</div>
        </div>
    </div>
        </div>
    </div>

@endsection