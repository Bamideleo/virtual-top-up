@include('users.common.header')
<div class="content-body">
<div class="container-fluid">
<div class="container-fluid">
		<!-- Row -->
		<div class="row">
			<div class="col-xl-12">
				 <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Contact Support</li>
					</ol>
				</div>
			</div>
			<div class="col-xl-12">
				<div class="filter cm-content-box box-primary">
					<div class="cm-content-body form excerpt">

                    @if(Session::has('message'))
                                    
									@elseif(Session::has('success'))
									<div class="alert alert-primary solid alert-end-icon alert-dismissible fade show">
											<span><i class="mdi mdi-account-search"></i></span>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
											</button> {{ Session::get('success', '') }}
										</div>
										@elseif(Session::has('error'))
                                        <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show">
											<span><i class="mdi mdi-account-search"></i></span>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
											</button> {{ Session::get('error', '') }}
										</div>    
											@endif
						<div class="card-body">
							<div class="row">
									<div class="col-xl-12">
                                        <form action="{{route('send-message')}}" method="post">
									<div class="mb-3">
										<label  class="form-label">Subject</label>
										<input class="form-control @error('subject') is-invalid @enderror" type="text" placeholder="Subject" name="subject" value="{{ old('subject') }}" required>
                                        @error('subject')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    </div>
									<label class="form-label">Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" rows="4" placeholder="Send Us Message" name="message"></textarea>
                                    @error('message')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
                                    <br>
								</div>
								
								<div class="text-end">
									<button type="submit" class="btn btn-primary">Send</button>
								</div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


@include('users.common.footer')