@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Slide</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<form method="GET">
						<div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Select screen</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" name="display">
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
							<div class="col-sm-1">
								<button type="submit" class="btn btn-primary btn-sm">Manage</button>
							</div>
                        </div>
					</form>

					@if(isset($displayImages))
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Display Name</th>
									<th scope="col">Background</th>
									<th scope="col">Signage 1</th>
									<th scope="col">Signage 2</th>
									<th scope="col">Video 1</th>
									<th scope="col">Video 2</th>
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
									</tr>
								@endforeach
							</tbody>
						</table>
					
						<form method="POST" enctype="multipart/form-data">
							
						</form>
					@endif
				</div>
        	</div>
    	</div>
	</div>
</div>
@endsection