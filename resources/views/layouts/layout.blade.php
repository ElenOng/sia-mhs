<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik</title>
	@include('layouts.header')
</head>
<body>
	@include('layouts.sidebar')
	<div id="right-panel" class="right-panel">
		@include('layouts.navbar')
		<div>
			@yield('content')
		</div>	
		@yield('footer')
	</div>
	@include('layouts.script')
</body>
</html>