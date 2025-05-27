@include('admin.common.header')
<div class="content-body">
<div class="container-fluid">
<div class="container-fluid">
		<!-- Row -->
		<div class="row">
			<div class="col-xl-12">
				 <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Notification</li>
					</ol>
				</div>
			</div>
			<div class="col-xl-12">
				<div class="filter cm-content-box box-primary">
					<div class="cm-content-body form excerpt">
						<div class="card-body">
							<div class="row">
									<div class="col-xl-12">
									<div class="mb-3">
										<label  class="form-label">Subject</label>
										<input class="form-control bg-light" type="text" value="{{$data->subject}}" placeholder="Slug" aria-label="Disabled input example" disabled>
									</div>
									<label class="form-label">Message</label>
									<div class="new-scroll">
										<div class="d-grid mb-3">
											<span>{{$data->message}}</span>
										</div>
									</div>
									<br>
								</div>
								
								<!-- <div class="text-end">
									<button type="button" class="btn btn-primary">Save EmailTemplate</button>
								</div> -->
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