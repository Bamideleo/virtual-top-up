@include('admin.common.header')

<div class="content-body ">
                <div class="container-fluid">
		
		
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">{{$data->first_name}} Profile</a></li>
			</ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
							<div class="profile-photo">
								<img src="public/images/profile/profile.png" class="img-fluid rounded-circle" alt="">
							</div>
							<div class="profile-details">
								<div class="profile-name px-3 pt-2">
									<h4 class="text-primary mb-0">{{$data->first_name}} {{$data->last_name}}</h4>
									<p>Fullname</p>
								</div>
								<div class="profile-email px-2 pt-2">
									<h4 class="text-muted mb-0">{{$data->email}}</h4>
									<p>Email</p>
								</div>
							
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="profile-statistics">
									<div class="text-center">
										<div class="row">
											<div class="col">
											    @if(!empty($wallet->wallet))
												<h3 class="m-b-0">&#8358;{{number_format($wallet->wallet,2)}}</h3><span>Balance</span>
											@endif
											</div>
											<div class="col">
												<h3 class="m-b-0">Active</h3><span>Status</span>
											</div>
										</div>
										<div class="mt-4">
										<a href="javascript:void(0);" class="btn btn-primary mb-1 me-1" data-bs-toggle="modal" data-bs-target="#addfundModal">Add fund</a> 
											<a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Send Message</a>
										</div>
									</div>
									<!-- Modal -->
									<div class="modal fade" id="sendMessageModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Send Message</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													<form class="comment-form" action="{{route('admin.send-message')}}" method="post">
														<div class="row"> 
															<div class="col-lg-6">
																<div class="mb-3">
																	<input type="hidden" name="id" value="{{$data->id}}">
																	<label class="text-black font-w600 form-label">Subject: <span class="required">*</span></label>
																	<input type="text" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" name="subject" placeholder="Author">
																	@error('subject')
																	<div class="invalid-feedback">
																	{{ $message }}
																	</div>
																	@enderror
																</div>
															</div>
															<div class="col-lg-6">
																<div class="mb-3">
																	<label class="text-black font-w600 form-label">Email <span class="required">*</span></label>
																	<input type="text" class="form-control @error('email') isinvalid @enderror" placeholder="Email" name="email" value="{{$data->email}}">
																	@error('email')
																	<div class="invalid-feedback">
																	{{ $message }}
																	</div>
																	@enderror
																</div>
															</div>
															<div class="col-lg-12">
																<div class="mb-3">
																	<label class="text-black font-w600 form-label">Message</label>
																	<textarea rows="8" class="form-control @error('email') isinvalid @enderror" name="message" placeholder="Message"></textarea>
																	@error('message')
																	<div class="invalid-feedback">
																	{{ $message }}
																	</div>
																	@enderror
																</div>
															</div>
															<div class="col-lg-12">
																<div class="mb-3 mb-0">
																	<input type="submit" value="Send" class="submit btn btn-primary" name="submit">
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>


									<!-- Modal -->
									<div class="modal fade" id="addfundModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Add Fund</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													<form action="{{route('admin.fund-wallet', $data->id)}}" method="post" class="comment-form">
														@csrf
														<div class="row"> 
															<div class="col-lg-12">
																<div class="mb-3">
																	<label class="text-black font-w600 form-label">Amount<span class="required">*</span></label>
																	<input type="number" class="form-control @error('amount') is-invalid @enderror"  name="amount" placeholder="Enter Your Amount">
												@error('amount')
                                                <div class="invalid-feedback">
                                                {{ $message }}
												</div>
                                                @enderror
																</div>
															</div>
															<!-- <div class="col-lg-6">
																<div class="mb-3">
																	<label class="text-black font-w600 form-label">Email <span class="required">*</span></label>
																	<input type="text" class="form-control" value="Email" placeholder="Email" name="Email">
																</div>
															</div> -->
															
															<div class="col-lg-12">
																<div class="mb-3 mb-0">
																	<input type="submit" value="Save" class="submit btn btn-primary" name="submit">
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
					</div>
					
					
		
				</div>
            </div>
            <div class="col-xl-8">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">

                                    <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link active show"></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="profile-settings" class="tab-pane active show fade">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <h4 class="text-primary">Account Setting</h4>
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
                                                <form action="{{route('admin.update-user',$data->id)}}" method="post">
                                                    @csrf
												<div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" value="{{$data->first_name}}" name="firstname" class="form-control " id="validationCustom01" name="firstname" placeholder="Enter your firstname" >
                
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" placeholder="Enter Your Lastname" name="lastname" class="form-control " value="{{$data->last_name}}">
                                                   
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" placeholder="Email" name="email" class="form-control " value="{{$data->email}}">
                                                     
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" placeholder="Enter Your Password" name="password" class="form-control">
                                                        </div>
                                                    </div>
													<div class="mb-3">
                                                            <label class="form-label">Phone Number</label>
                                                            <input type="text" placeholder="Enter Your Phone" name="phone_number" value="{{$data->phone_no}}" class="form-control">
                                                        </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Address</label>
                                                        <input type="text" name="address" placeholder="" class="form-control" value="{{$data->address}}">
                                                    </div>
                                                   
													
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-- Modal -->
							<div class="modal fade" id="replyModal">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Post Reply</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<form>
												<textarea class="form-control" rows="4">Message</textarea>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Reply</button>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

@include('admin.common.footer')
