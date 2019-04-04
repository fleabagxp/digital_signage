@extends('layouts.app')

@section('content')
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="reject" method="POST" action="">
                @method('DELETE') 
				@csrf
                
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle">{{__('ลบสไลด์')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                    <div class="form-group">
                        <label for="deleteModal">{{__('ต้องการลบสไลด์ใช่หรือไม่')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('ยกเลิก')}}</button>
                    <button type="submit" class="btn btn-danger">{{__('ลบ')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Slide</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
					@elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

					<form method="GET">
						<div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Select screen</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" name="display" id="display">
									<option value="0">เลือกจอ</option>
                                    @foreach($displays as $display)
										@if(isset($displayID) && $displayID == $display->id)
                                        	<option value="{{ $display->id }}" selected>{{ $display->name }}</option>
										@else
											<option value="{{ $display->id }}">{{ $display->name }}</option>
										@endif
                                    @endforeach
                                </select>
                            </div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-primary btn-sm">Manage</button>
								<a role="button" href="#" onclick="javascript:openPreview()" class="btn btn-secondary btn-sm">Preview</a>
							</div>
                        </div>
					</form>

					@if(isset($displayImages))
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th>Display Name</th>
									<th>Background</th>
									<th>Signage 1</th>
									<th>Signage 2</th>
									<th>Video 1</th>
									<th>Video 2</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($displayImages as $displayImage)
									<tr>
										<th scope="row">{{ $displayImage->id }}</th>
										<td>{{ $displayImage->display->name }}</td>
										<td>
											@if(isset($displayImage->bg_path))
												<img src="{{ $displayImage->bg_path }}"  class="img-thumbnail">
											@else
												<img src="{{ url('/images/noimage.jpg') }}"  class="img-thumbnail">
											@endif
										</td>
										<td>
											@if(isset($displayImage->signage1_path))
												<img src="{{ $displayImage->signage1_path }}"  class="img-thumbnail">
											@else
												<img src="{{ url('/images/noimage.jpg') }}"  class="img-thumbnail">
											@endif
										</td>
										<td>
											@if(isset($displayImage->signage2_path))
												<img src="{{ $displayImage->signage2_path }}"  class="img-thumbnail">
											@else
												<img src="{{ url('/images/noimage.jpg') }}"  class="img-thumbnail">
											@endif
										</td>
										<td>
											@if(isset($displayImage->video1_path))
												<video style="max-width: 100%; height: auto;" controls="controls" preload="metadata">
													<source  src="{{ $displayImage->video1_path }}#t=0.5"  class="img-thumbnail" type="video/mp4">
												</video>
											@else
												<img src="{{ url('/images/noimage.jpg') }}"  class="img-thumbnail">
											@endif
										</td>
										<td>
											@if(isset($displayImage->video2_path))
												<video style="max-width: 100%; height: auto;" controls="controls" preload="metadata">
													<source  src="{{ $displayImage->video2_path }}#t=0.5"  class="img-thumbnail" type="video/mp4">
												</video>
											@else
												<img src="{{ url('/images/noimage.jpg') }}"  class="img-thumbnail">
											@endif
										</td>
										<td>
											<button class="btn btn-danger" onclick="javascript:deleteModal('{{ route('manage.delete', $displayImage->id) }}')" data-toggle="modal" data-target="#deleteModal">ลบ</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
        	</div>
    	</div>
	</div>
</div>
@endsection

@section('customJS')
<script>
	function deleteModal(deleteUrl)
    {
        var approveModal = $('#deleteModal');
        approveModal.find('form').attr('action', deleteUrl);
    }

	function openPreview()
	{
		var displayID = $("#display").val();

		if(parseInt(displayID) !== 0)
			window.open('/display/' + displayID, '_blank');
		else
			alert("Please select display.");
	}
</script>
@endsection