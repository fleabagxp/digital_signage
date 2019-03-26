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
						<div class="carousel-item active">
							<img class="d-block w-100" src="https://futureforwardparty.org/wp-content/uploads/2018/10/product-02.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="https://futureforwardparty.org/wp-content/uploads/2018/10/product-02.jpg" alt="Second slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="https://futureforwardparty.org/wp-content/uploads/2018/10/product-02.jpg" alt="Third slide">
						</div>
						@php
							$i = 0;
						@endphp
						@foreach($displayImages as $displayImage)
							$i++;
							@if($displayImage->position === 'signage1')
								<div class="carousel-item {{$i == 1 ? 'active' : ''}}">
									<img class="d-block w-100" src="https://futureforwardparty.org/wp-content/uploads/2018/10/product-02.jpg" alt="Third slide">
								</div>
							@endif
						@endforeach
					</div>
				</div>
				@foreach($displayImages as $displayImage)
					<div class="col-md-12 top">
						@if($displayImage->position === 'signage1')
							<img src="{{ $displayImage->path }}" style="height: 520px;">
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
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		$('.carousel').carousel({
			interval: 8000
		})
	</script>
</html>

