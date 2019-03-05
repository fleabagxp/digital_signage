<!DOCTYPE html>
<html>
	<head>
	<title>{{ $display->name }}</title>
		<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<style>
			body {
				background-image: url("{{ $displayImages->where('position', 'bgimage')->first()->path }}");
				background-size:     cover;
				background-repeat:   no-repeat;
				background-position: top;
			}
			img {
				width: 100%;
				height: auto;
			}
			.top {
				margin: 0;
				padding: 0;
				margin-top: 24%;
			}
			.bottom {
				margin: 0;
				padding: 0;			
			}
		</style>	
<body>
	<div class="container-fluid">
		<div class="row">
			@foreach($displayImages as $displayImage)
				<div class="col-md-12 top">
					@if($displayImage->position === 'signage1')
						<img src="{{ $displayImage->path }}">
					@endif
				</div>
				
				<div class="col-md-12 fixed-bottom bottom">
					@if($displayImage->position === 'signage2')
						<img src="{{ $displayImage->path }}">
					@endif
				</div>
				
			@endforeach
		</div>
	</div>
	
</body>
</head>
</html>

