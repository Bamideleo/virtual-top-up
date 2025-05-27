@include('admin.common.header')
<div class="content-body">
    <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)"><h4>Users List</h4></a></li>
			</ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-12" >
                            <form action="{{route('admin.search-user')}}" method="GET">
                            <div class="input-group search-area">
                           <button type="submit" class="btn btn-light"><i class="flaticon-381-search-2"></i></button>
                            <input type="text" class="form-control" placeholder="Enter Email or Firstname" name="name">
                        </div>
                            </form>
                            </div>
                        </div>
                    </div>
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
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>FUll Name</strong></th>
                                        <th><strong>Phone Number</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>STATUS</strong></th>
										<th class="text-end"><strong>Action</strong></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                @forelse ($data as $user) 
                                    <tr>
                                        <td><strong>{{$i}}</strong></td>
                                        <td>{{$user->first_name}}  {{$user->last_name}}</td>
                                        <td>{{$user->phone_no}}</td>
                                        <td>{{$user->email}}</td>
                                        @if($user->type == 1)
                                        <td><span class="badge light badge-success">Active</span></td>
                                        @else
                                        <td><span class="badge light badge-danger">Disable</span></td>
                                        @endif
                                        <td class="text-end">
											<div class="dropdown">
												<button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
													<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="{{route('admin.edit-user',$user->id)}}">Edit</a>
                                                    @if($user->type == 1)
                                                    <a class="dropdown-item act-ive" href="javascript:void()"  data-id="{{$user->id}}" data-type="{{$user->type}}">Disable</a>
                                                    @else
                                                    <a class="dropdown-item act-ive" href="javascript:void()" data-id="{{$user->id}}" data-type="{{$user->type}}">Enable</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{route('admin.delete-user',$user->id)}}">Delete</a>
												</div>
											</div>
										</td>
                                    </tr>
                                  

                                    @php
                                    $i++;
                                    @endphp
                                    @empty
                                        <p>No users</p>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $data->links ('vendor.pagination.bootstrap-4') }}
                           
                        </div>
                    </div>
                </div>
            </div>


</div>
</div>
</div>


@include('admin.common.footer')