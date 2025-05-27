@include('admin.common.header')
<div class="content-body ">
    <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)"><h4>Transactions</h4></a></li>
			</ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-12" >
                            <form action="{{route('admin.search-history')}}" method="GET">
                            <div class="input-group search-area">
                           <button type="submit" class="btn btn-light"><i class="flaticon-381-search-2"></i></button>
                            <input type="text" class="form-control" placeholder="Enter Fullname or Reference" name="name">
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
                                        <th><strong>Reference</strong></th>
                                        <th><strong>Amount</strong></th>
                                        <th><strong>Type</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Status</strong></th>
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
                                        <td>{{$user->fullname}}</td>
                                        <td>{{$user->reference}}</td>
                                        <td>&#8358;{{number_format($user->amount,2)}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>{{$user->created_at->format('d-m-Y')}}</td>
                                        <td><span class="badge light badge-success">Completed</span></td>
                                        <td class="text-end">
                                            @if($user->type == "Transfer")
                                        <a  href="#" id="revert" data-id="{{$user->id}}" title="Revert"><i class="fa fa-rotate-right"></i></a>
										@endif
                                        
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