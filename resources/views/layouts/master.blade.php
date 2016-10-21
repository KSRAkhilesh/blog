<!DOCTYPE html>
<html lang="">
<head>
	@include('partials.header')
	@yield('styles')
</head>
<body>
	@include('partials.nav')
	<div class="container">
		@include('partials.messages')	
		@yield('content')
	</div>
	@include('partials.footer')
	@include('partials.javascript')
	@yield('scripts')
</body>
</html>