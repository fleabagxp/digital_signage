<!DOCTYPE html>
<head>
	<META HTTP-EQUIV="Refresh" Content="591";URL=/display/7">
</head>
<html>
	<head>
	<title>{{ $display->name }}</title>
		<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<style>
			body {
				background-image: url("{{ $displayImages->where('position', 'bgimage')->first() ? $displayImages->where('position', 'bgimage')->first()->path : url('/images/bg.jpg') }}");
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
				@if(isset($displayImages->where('position', 'video1')->first()->position) && $displayImages->where('position', 'video1')->first()->position === 'video1')
				<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
					<source src="{{ $displayImages->where('position', 'video1')->first()->path }}" type="video/mp4">
				</video>
				@elseif(isset($displayImages->where('position', 'signage1')->first()->position) && $displayImages->where('position', 'signage1')->first()->position === 'signage1')
					<img class="img-pad" src="{{ $displayImages->where('position', 'signage1')->first()->path }}">
				@endif
			</header>
			<section>
				@if(isset($displayImages->where('position', 'signage2')->first()->position) && $displayImages->where('position', 'signage2')->first()->position === 'signage2')
					<img src="{{ $displayImages->where('position', 'signage2')->first()->path }}">
				@endif
			</section>
		</div>
	</body>
</html>
