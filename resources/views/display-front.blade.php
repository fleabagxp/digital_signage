<!DOCTYPE html>
<html>
	<head>
		<title>{{ $display->name }}</title>
		<meta HTTP-EQUIV="Refresh" Content="591";URL="/display/{{ $display->id }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<style>
			body {
				background-image: url("{{ $displayImages->first() && $displayImages->first()->bg_path ? $displayImages->latest()->first()->bg_path : url('/images/bg.jpg') }}");
				background-size: cover;
				background-repeat: no-repeat;
				background-position: top;
			}
			header {
				height: 43vh;
				width: 100%;
			}
			img {
				width: 100%;
				height: auto;
			}
			video {
				width: 100%;
				height: auto;
				top: 50%;
				position: relative;
				transform: translateY(-50%);
			}
			.img-pad {
				width: 100%;
				height: auto;
				top: 50%;
				position: relative;
				transform: translateY(-50%);
			}
			.container-fluid {
				margin: 0;
				padding: 0;
			}
			.top {
				height: 14vh;
			}
			.bottom {
				margin: 0;
				padding: 0;			
			}
		</style>	
	</head>
	<body>
		<div class="container-fluid">
			<section class="top"></section>
			<header>
				@if($displayImages->first() && $displayImages->first()->video1_path)
				<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
					<source src="{{ $displayImages->latest()->first()->video1_path }}" type="video/mp4">
				</video>
				@elseif($displayImages->first() && $displayImages->first()->signage1_path)
					<img class="img-pad" src="{{ $displayImages->latest()->first()->signage1_path }}">
				@endif
			</header>
			<section>
				@if($displayImages->first() && $displayImages->first()->signage2_path)
					<img src="{{ $displayImages->latest()->first()->signage2_path }}">
				@endif
			</section>
		</div>
	</body>
</html>
