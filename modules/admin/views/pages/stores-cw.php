<!DOCTYPE html>
<?php $path = '//'.$_SERVER['HTTP_HOST'].'/dist/stores/';?>
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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

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
					<li class="active" rel="tab1">ENGLAND</li>
					<li rel="tab2">SCOTLAND</li>
					<li rel="tab3">WALES</li>
				</ul>
			</div>
		</div>
	<div class="content-for-tabs">
		<div>		
			<div class="tab_container">
				<h3 class="d_active tab_drawer_heading" rel="tab1">ENGLAND</h3>

				<div id="tab1" class="tab_content">
                                        <p>Basildon Superstore</p><br/>
                                        <p>Telford Superstore</p><br/>
                                        <p>Greenford</p><br/>
                                        <p>Southampton (Hedge End 3)</p><br/>
                                        <p>Hull 2</p><br/>
                                        <p>Birmingham 7 (New St)</p><br/>
                                        <p>Reading (The Oracle)</p><br/>
                                        <p>Southampton (Above Bar)</p><br/>
                                        <p>Grantham (High St)</p><br/>
                                        <p>Tonbridge</p><br/>
                                        <p>Doncaster (North Mall)</p><br/>
                                        <p>St Helens 2</p><br/>
                                        <p>Edinburgh (Kinnaird)</p><br/>
                                        <p>Birmingham (Oldbury)</p><br/>
                                        <p>Southport 2</p><br/>
                                        <p>Sheffield Fargate</p><br/>
                                        <p>Leeds (Briggate)</p><br/>
                                        <p>Great Yarmouth</p><br/>
                                        <p>Stockport (Portwood)</p><br/>
                                        <p>Poole</p><br/>
                                        <p>Bluewater (Unit L007)</p><br/>
                                        <p>Merry Hill 3</p><br/>
                                        <p>Brighton (38 Churchill Square)</p><br/>
                                        <p>Newcastle 4 (Metro Ctr)</p><br/>
                                        <p>Haywards Heath (Orchard Ctr)</p><br/>
                                        <p>Portsmouth (Commercial Rd)</p><br/>
                                        <p>Edinburgh (Ocean Terminal)</p><br/>
                                        <p>Hornchurch (High St)</p><br/>
                                        <p>Saffron Walden (King Street)</p><br/>
                                        <p>Manchester (163-164 Arndale Ctr)</p><br/>
                                        <p>Wood Green (The Mall)</p><br/>
                                        <p>Bristol (Broadmead 2)</p><br/>
                                        <p>Manchester 22 (Trafford Centre)</p><br/>
                                        <p>Leeds (White Rose SC)</p><br/>
                                        <p>White City (Westfield SC)</p><br/>
                                        <p>St Neots (Market Sq)</p><br/>
                                        <p>Petersfield (The Square)</p><br/>
                                        <p>Belfast (Castle Court SC)</p><br/>
                                        <p>Paignton (Victoria Street)</p><br/>
                                        <p>Salisbury (New Canal)</p><br/>
                                        <p>Blackpool (Houndshill SC)</p><br/>
                                        <p>Luton (U77-79 Arndale Centre)</p><br/>
                                        <p>Taunton (Fore Street)</p><br/>
                                        <p>Cardiff (Capital Shopping Park)</p><br/>
                                        <p>Brent Cross SC (Unit V6a)</p><br/>
					<a href="#" class="top"></a>
				</div>
				<!-- #tab1 -->

				<h3 class="tab_drawer_heading" rel="tab2">SCOTLAND</h3>
				<div id="tab2" class="tab_content">
				<!--<h2>Tab 2 content</h2>-->
                                        <p>Glasgow (Superstore)</p><br/>
                                        <p>Glasgow (Unit 41 Braehead)</p><br/>
                                        <p>Aberdeen (Union Square)</p><br/>
					<a href="#" class="top"></a>
				</div>
				<!-- #tab2 -->

				<h3 class="tab_drawer_heading" rel="tab3">WALES</h3>
				<div id="tab3" class="tab_content">
				<!--<h2>Tab 3 content</h2>-->
                                    <p>Neath</p></br>
				</div>
				<!-- #tab3 -->

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
				<?= '<a href="http://'. $_SERVER['HTTP_HOST'] .'/terms-and-conditions?c=cw" targe="_blank">Please click here to view terms and conditions</a>';?>
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
