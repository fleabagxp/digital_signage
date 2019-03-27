<!DOCTYPE html>
<html>
	<head>
		<title>{{ $display->name }}</title>
		<meta HTTP-EQUIV="Refresh" Content="591";URL="/display/{{ $display->id }}">
		<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<style>
			body {
				background-image: url("{{ $displayImages->where('position', 'bgimage')->first() ? $displayImages->where('position', 'bgimage')->first()->path : url('/images/bg.jpg') }}");
				background-size:     cover;
				background-repeat:   no-repeat;
				background-position: top;
			}

			.carousel {
				width: 100%;
				height: 100%;
			}

			.carousel-item {
				height: 100vh;
				vertical-align: middle;
			}

			.carousel-item img{
				max-height: 100%;  
				max-width: 100%; 
				width: auto;
				height: auto;
				position: absolute;  
				top: 0;  
				bottom: 0;  
				left: 0;  
				right: 0;  
				margin: auto;
			}
			
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						@php
							$i = 0;
						@endphp
						@foreach($displayImages as $displayImage)
							@php
								$i++;
							@endphp
							@if($displayImage->position === 'signage1' || $displayImage->position === 'signage2')
								<div class="carousel-item {{$i == 1 ? 'active' : ''}}">
									<img class="d-block w-100" src="{{ $displayImage->path }}">
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		$('.carousel').carousel({
			interval: 8000
		})
	</script>
</html>

