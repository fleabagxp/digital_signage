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
			video {
				width: 100%;
				height: auto;
			}
			.top {
				margin: 0;
				padding: 0;
				margin-top: 36%;
			}
			.bottom {
				margin: 0;
				padding: 0;			
			}
		</style>	
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 top">
				@if(isset($displayImages->where('position', 'signage1')->first()->position) && $displayImages->where('position', 'signage1')->first()->position === 'signage1')
				<video controls autoplay loop>
					<source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
				</video>
				@elseif(isset($displayImages->where('position', 'signage1')->first()->position) && $displayImages->where('position', 'signage1')->first()->position === 'signage1')
					<img src="{{ $displayImages->where('position', 'signage1')->first()->path }}">
				@endif
			</div>
				
			<div class="col-md-12 fixed-bottom bottom">
				@if(isset($displayImages->where('position', 'signage1')->first()->position) && $displayImages->where('position', 'signage2')->first()->position === 'signage2')
					<img src="{{ $displayImages->where('position', 'signage2')->first()->path }}">
				@endif
			</div>
		</div>
	</div>
</body>
</head>
</html>

