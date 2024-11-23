<!doctype html>
<html lang="en">

        <!-- Start Header -->
        @include('source.partials.header')
    	<!-- End Header -->

	<body>

		<!-- Start Header/Navigation -->
		@include('source.partials.nav')
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
        @include('source.partials.sidenav')
		<!-- End Hero Section -->

        {{-- Start Content Section --}}
		@yield('content')
        {{-- End Content Section --}}

		<!-- Start Footer Section -->
		@include('source.partials.footer')
		<!-- End Footer Section -->	


		
	</body>

</html>
