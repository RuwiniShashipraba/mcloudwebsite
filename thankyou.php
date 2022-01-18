<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thank You | M cloud</title>
	<link rel="icon" href="images/logo.png">
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
		

		.button {
			display: inline-block;
			border-radius: 4px;
			background-color: #1148c3;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 20px;
			padding: 10px;
			width: 150px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 5px;
			}

			.button span {
				cursor: pointer;
				display: inline-block;
				position: relative;
				transition: 0.5s;
			}

			.button span:after {
				content: '\00bb';
				position: absolute;
				opacity: 0;
				top: 0;
				right: -20px;
				transition: 0.5s;
			}

			.button:hover span {
				padding-right: 25px;
			}

			.button:hover span:after {
				opacity: 1;
				right: 0;
			}
	</style>

	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>

</head>

<body>
	<header class="site-header" id="header">
		<h2 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h2>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">Your submission has been recorded.</p>
		<p class="main-content__body" data-lead-id="main-content-body">Thanks a bunch for filling that out. It means a lot to us, just like you do! <br>We really appreciate you giving us a moment of your time today.</p>
		<p class="main-content__body" data-lead-id="main-content-body">Stay Safe, Stay healthy</p>

		<br>
		<br>
		<button class="button" style="vertical-align:middle" onclick = "location.href= 'https://m-cloud.herokuapp.com';"><span>Continue </span></button>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2021 | All Rights Reserved | M Cloud</p>
	</footer>
</body>
</html>
