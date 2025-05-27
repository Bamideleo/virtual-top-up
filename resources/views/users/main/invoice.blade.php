@include('users.common.header')

<div class="content-body ">
                <div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Invoice</li>
			</ol>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card mt-3">
                    <div class="card-header"> Invoice <strong>{{$data->created_at->format('d-m-Y')}}</strong> <span class="float-end">
                            <strong>Status:</strong> Completed</span> </div>
                    <div class="card-body">
                        <div class="row mb-5">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-black">Item</th>
                                        <th class="text-black">Description</th>
                                        <th class="text-black">Pin</th>
                                        <th class="text-black">Serial Number</th>
                                 <th class="right  text-black">Token</th> 
                                     <th class="right  text-black">Units</th> 
                                      <th class="right  text-black">Address</th> 
                                       <th class="right  text-black">Name</th> 
                                      <th class="right  text-black">Purchase Code</th> 
                                     <th class="right  text-black">Phase</th>
                                <th class="right  text-black">Unit Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="left strong">{{$data->type}}</td>
                                        <td class="left">{{$data->status}}</td>
                                        <td class="left">{{$data->pin}}</td>
                                        <td class="left">{{$data->serialNumber}}</td>
                                         <td class="right">{{$data->token}}</td> 
                                          <td class="right">{{$data->units}}</td>
                                           <td class="right">{{$data->customerAddress}}</td>
                                      <td class="right">{{$data->customerName}}</td>
                                        <td class="right">{{$data->purchase_code}}</td>
                                          <td class="right">{{$data->phase}}</td>
                                        <td class="right">&#8358;{{number_format($data->amount, 2)}}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"> </div>
                            <div class="col-lg-4 col-sm-5 ms-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                                  <td class="left"></td>
                                                  <td class="left"></td>
                                                  <td class="left"></td>
                                            <td class="right">&#8358;{{number_format($data->amount, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount</strong></td>
                                            <td class="left"></td>
                                                  <td class="left"></td>
                                                  <td class="left"></td>
                                            <td class="right">0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>VAT</strong></td>
                                            <td class="left"></td>
                                                  <td class="left"></td>
                                                  <td class="left"></td>
                                            <td class="right">0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="left"></td>
                                                  <td class="left"></td>
                                                  <td class="left"></td>
                                                  
                                            <td class="right"><strong>&#8358;{{number_format($data->amount, 2)}}</strong><br>
                                               </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

@include('users.common.footer')