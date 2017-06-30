<!DOCTYPE html>
<?php $path = 'https://'.$_SERVER['HTTP_HOST'].'/dist/stores/';?>
<html lang="en">
<head>

	<!-- BASE -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<!-- SITE TITLE -->
	<title>Selfie Studio</title>

	<!-- DESCRIPTION -->
	<meta name="description" content="">

	<!-- KEYWORDS -->
	<meta name="keywords" content="">

	<!-- GOOGLE FONT -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="<?= $path ?>css/style.css">

	<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous"></script>

	<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/plugins/html5shiv.js"></script>
	<![endif]-->
</head>

<body>


	<header class="header-bg">
		<div class="header-center">
			<h1>SELFIE STUDIO</h1>
			<h2>LOCATIONS</h2>
		</div>
	</header>

	<div class="content-center-bg">
		<div class="content-center">
			<div class="tabs-bg">
				<ul class="tabs">
					<li class="active" rel="tab1">DEUTSCHLAND</li>
					<li rel="tab2">IRELAND</li>
					<li rel="tab3">SOUTH AFRICA</li>
					<li rel="tab4">ROMÂNIA</li>
					<li rel="tab5">ČESKÁ REPUBLIKA</li>
				</ul>
			</div>
			<div class="tab_container">
				<h3 class="d_active tab_drawer_heading" rel="tab1">DEUTSCHLAND</h3>

				<div id="tab1" class="tab_content">
				<h2>Tab 1 content</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac metus augue.</p>
				</div>
				<!-- #tab1 -->

				<h3 class="tab_drawer_heading" rel="tab2">IRELAND</h3>
				<div id="tab2" class="tab_content">
				<h2>Tab 2 content</h2>
					<p>Nunc dui velit, scelerisque eu placerat volutpat, dapibus eu nisi. Vivamus eleifend vestibulum odio non vulputate.</p>
				</div>
				<!-- #tab2 -->

				<h3 class="tab_drawer_heading" rel="tab3">SOUTH AFRICA</h3>
				<div id="tab3" class="tab_content">
				<h2>Tab 3 content</h2>
					<p>Nulla eleifend felis vitae velit tristique imperdiet. Etiam nec imperdiet elit. Pellentesque sem lorem, scelerisque sed facilisis sed, vestibulum sit amet eros.</p>
				</div>
				<!-- #tab3 -->

				<h3 class="tab_drawer_heading" rel="tab4">ROMÂNIA</h3>
				<div id="tab4" class="tab_content">
				<h2>Tab 4 content</h2>
					<p>Integer ultrices lacus sit amet lorem viverra consequat. Vivamus lacinia interdum sapien non faucibus. Maecenas bibendum, lectus at ultrices viverra, elit magna egestas magna, a adipiscing mauris justo nec eros.</p>
				</div>
				<!-- #tab4 -->

				<h3 class="tab_drawer_heading" rel="tab5">ČESKÁ REPUBLIKA</h3>
				<div id="tab5" class="tab_content">
				<h2>Tab 5 content</h2>
					<p>Vivamus lacinia interdum sapien non faucibus. Maecenas bibendum, lectus at ultrices viverra, elit magna egestas magna, a adipiscing mauris justo nec eros.</p>
				</div>
				<!-- #tab5 -->

			</div>
			<!-- .tab_container -->
		</div>
	</div>

	<footer class="footer-bg">
		<div class="footer">

			<div class="logo-huawei">
				<img src="<?= $path ?>img/huawei.png" alt="huwaei">
			</div>

			<div class="footer-text">
				<a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=ir'; ?>">
				Please click here to view terms and conditions</a>
			</div>

			<div class="logo-vodafone">
				<img src="<?= $path ?>img/vodafone.png" alt="vodafone">
			</div>

		</div>
	</footer>










	<!--jQuery JavaScript Library -->
	<!-- <script type="text/javascript" src="js/jquery-1.9.1.js"></script> -->
	<script type="text/javascript" src="<?= $path ?>js/main.js"></script>




</body>
</html>
