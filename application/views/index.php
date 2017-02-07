<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>HAWC</title>
	<meta name="description" content="The HTML5 HAWC">
	<meta name="author" content="Manuel">

	<link rel="stylesheet" href="<?php echo asset_url('css/styles.css?v=1.0') ?>">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bootstrap 101 Template</title>

	<!-- Bootstrap -->
	<link href="<?php echo asset_url("css/bootstrap.min.css") ?>" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="masthead">
				<h1>HAWC <small>Advances</small></h1>
				<nav>
					<ul class="nav nav-tabs nav-justified">
						<li class="active" role="presentation"><a href="#hawc" data-toggle="tab">HAWC</a></li>
						<li role="presentation"><a href="#query" data-toggle="tab">QMDB</a></li>
						<li role="presentation"><a href="#variable" data-toggle="tab">variable</a></li>
						<li role="presentation"><a href="#about" data-toggle="tab">about</a></li>
					</ul>
				</nav>
			</div>
			<div class="tab-content body-heigth" id="tabs">
				<div class="tab-pane  active" id="hawc">
					<h3>About HAWC</h3>
					<p>HAWC is a facility designed to observe gamma rays and cosmic rays between 100 GeV and 100 TeV. TeV gamma rays are the highest energy photons ever observed — 1 TeV is 1 trillion electron volts (eV), about 1 trillion times more energetic than visible light! These photons are born in the most extreme environments in the known universe: supernova explosions, active galactic nuclei, and gamma-ray bursts.</p>
				</div>
				<div class="tab-pane" id="query">
					<h3>Query generator</h3>
				</div>
				<div class="tab-pane" id="variable">
					<h3>Variable editor</h3>
				</div>
				<div class="tab-pane" id="about">
					<h3>About</h3>
				</div>
			</div>
			<footer class="footer">

				<p class="center">the HAWC Collaboration</p>
			</footer>



		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo asset_url("js/bootstrap.min.js") ?>"></script>
		<script src="<?php echo asset_url("js/script.js") ?>"></script>
		<!-- Site footer -->
</body>
</html>