<!DOCTYPE html>
<html>
	<head>
		<title>{{ $display->name }}</title>
		<meta HTTP-EQUIV="Refresh" Content="591";URL="/display/{{ $display->id }}">
		<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<style>
			body {
				width: 100%;
				height: 100%;
				background-image: url("{{ url('/images/bg.jpg') }}");
				background-size:     cover;
				background-repeat:   no-repeat;
				background-position: top;
			}

			.bg {
				width: 100%;
				height: 100%;
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

			.signage1{
				max-height: 100%;  
				max-width: 100%; 
				width: auto;
				height: auto;
				position: relative;  
				top: 2vh;  
				bottom: 0;  
				left: 0;  
				right: 0;  
				margin: auto;
			}

			.signage2{
				max-height: 100%;  
				max-width: 100%; 
				width: auto;
				height: auto;
				position: relative;  
				top: 7vh;  
				bottom: 0;  
				left: 0;  
				right: 0;  
				margin: auto;
			}
			
			.top {
				height: 14vh;
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
							<div class="carousel-item {{$i == 1 ? 'active' : ''}}">
								<div class="bg" style="background-image: url('{{ $displayImage->bg_path ? $displayImage->bg_path : url('/images/bg.jpg') }}');">
									<section class="top"></section>
									@if($displayImage->video1_path)
									<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" class="signage1">
										<source src="{{ $displayImage->video1_path }}" type="video/mp4">
									</video>
									@elseif($displayImage->signage1_path)
										<img class="d-block w-100 signage1" src="{{ $displayImage->signage1_path }}">
									@endif
									@if($displayImage->video2_path)
									<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" class="signage2">
										<source src="{{ $displayImage->video2_path }}" type="video/mp4">
									</video>
									@elseif($displayImage->signage2_path)
										<img class="d-block w-100 signage2" src="{{ $displayImage->signage2_path }}">
									@endif
								</div>
							</div>
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

