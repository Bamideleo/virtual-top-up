@include('admin.common.header')
<div class="content-body ">
    <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><a href="javascript:void(0)"><h4>Purchase History</h4></a></li>
			</ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                          <th><strong>Transaction ID</strong></th>
                                        <th><strong>Type</strong></th>
                                        	<th class="text-end"><strong>Amount</strong></th>
                                        <th><strong>Phone Number</strong></th>
                                        <th><strong>Status</strong></th>
									
                                        <th><strong>Date</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                @forelse ($data as $user) 
                                    <tr>
                                        <td><strong>{{$i}}</strong></td>
                                        <td>{{$user->transaction_id}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>{{$user->amount}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>{{$user->status}}</td>
                                        <td>{{$user->date}}</td>
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