@include('admin.common.header')

<div class="content-body ">
                <div class="container-fluid">
		
		
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)">{{$data->name}} Profile</a></li>
			</ol>
        </div>
        <!-- row -->
        <div class="row">
        
            <div class="col-xl-12">
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
                                                <form action="{{route('admin.save-profile')}}" method="post">
                                                    @csrf
												<div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" value="{{$data->name}}" name="name" class="form-control " id="validationCustom01" name="firstname" placeholder="Enter your firstname" >
                
                                                        </div>
                                    
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" placeholder="Email" name="email" class="form-control " value="{{$data->email}}">
                                                     
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" placeholder="Enter Your Password" name="password" class="form-control">
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
