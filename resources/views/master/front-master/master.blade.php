<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
    @include('master.front-master.includes.css')
</head>
<body>
@include('master.front-master.includes.header')
<!-- Header End====================================================================== -->
    @yield('slider')
<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
                @include('master.front-master.includes.sidebar')
			<!-- Sidebar end=============================================== -->

			@yield('body')

		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
    @include('master.front-master.includes.footer')

<!-- Placed at the end of the document so the pages load faster ============================================= -->
    @include('master.front-master.includes.js')

</body>
</html>
