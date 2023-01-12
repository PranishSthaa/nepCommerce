<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Ecommerce</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="home/css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="home/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="home/css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="home/css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="home/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="home/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		@include('home.header')
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		{{-- @include('home.nav') --}}
		<!-- /NAVIGATION -->

		<!-- SECTION -->
		@include('home.hero')
		<!-- /SECTION -->

		<!-- SECTION -->
		@include('home.newProduct')
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		@include('home.hotDeal')
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		@include('home.topSelling')
		<!-- /SECTION -->

		<!-- SECTION -->
		@include('home.columnAd')
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		{{-- @include('home.newsletter') --}}
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		@include('home.footer')
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="home/js/jquery.min.js"></script>
		<script src="home/js/bootstrap.min.js"></script>
		<script src="home/js/slick.min.js"></script>
		<script src="home/js/nouislider.min.js"></script>
		<script src="home/js/jquery.zoom.min.js"></script>
		<script src="home/js/main.js"></script>

	</body>
</html>
