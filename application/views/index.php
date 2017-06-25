<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>HAWC QMSBi</title>
	<meta name="description" content="The HTML5 HAWC">
	<meta name="author" content="Manuel Heredia Navarrete">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo asset_url('css/styles.css?v=1.0') ?>">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bootstrap 101 Template</title>

	<!-- Bootstrap -->
	<link href="<?php echo asset_url("css/bootstrap.min.css") ?>" rel="stylesheet">
	<link href="<?php echo asset_url("css/dataTables.bootstrap.min.css") ?>" rel="stylesheet">
	<link href="<?php echo asset_url("css/jquery.dataTables.min.css") ?>" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo asset_url('css/bootstrap-datetimepicker.min.css') ?>">


	<script type="text/javascript">
		var baseurl = "<?php echo base_url() ?><?php  ?>";
		var urlBase = "<?php echo site_url('index.php') ?><?php  ?>";
	</script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="contenedor">
			<div class="masthead">
				<h1>HAWC <small>Quality Monitor DataBase Interface</small></h1>
				<!-- <nav>
					<ul class="nav nav-tabs nav-justified">
						<li class="active" role="presentation"><a href="#hawc" data-toggle="tab">HAWC</a></li>
						<li role="presentation"><a href="#query" data-toggle="tab">QMDB</a></li>
						<li role="presentation" class=""><a href="#variable" data-toggle="tab">Variable</a></li>
						<li role="presentation"><a href="#about" data-toggle="tab">about</a></li>
					</ul>
				</nav> -->
			</div>
				<?php $this->view('query_buldier',$data["tables"]=$tables); ?>
			<!-- <div class="tab-content body-heigth" id="tabs">
				<div class="tab-pane active" id="hawc">
					<h3>About HAWC</h3>
					<p>HAWC is a facility designed to observe gamma rays and cosmic rays between 100 GeV and 100 TeV. TeV gamma rays are the highest energy photons ever observed — 1 TeV is 1 trillion electron volts (eV), about 1 trillion times more energetic than visible light! These photons are born in the most extreme environments in the known universe: supernova explosions, active galactic nuclei, and gamma-ray bursts.</p>
				</div>
				<div class="tab-pane " id="query">

				</div>
				<div class="tab-pane " id="variable">
					<?php //$this->view('variable'); ?>
				<div class="tab-pane" id="about">
					<h3>About</h3>
				</div>
			</div> -->
			<footer class="footer navbar-fixed-bottom">

				<p class="center">the HAWC Collaboration</p>
			</footer>



		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="<?php echo asset_url("js/jquery.dataTables.min.js") ?>"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo asset_url("js/bootstrap.min.js") ?>"></script>
		<!-- <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js"></script> -->

		<script src="<?php echo asset_url("js/moment-with-locales.min.js") ?>"></script>
		<script src="<?php echo asset_url("js/bootstrap-datetimepicker.min.js") ?>"></script>
		<script src="<?php echo asset_url("js/script.js") ?>"></script>

		<script src="<?php echo asset_url("js/dataTables.bootstrap.min.js") ?>"></script>

		<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
		<script src="dist/clipboard.min.js"></script>
		<!-- Site footer -->
		<div class="modal">
			<div style="text-align: center; vertical-align: middle;"><h1>LOADING</h1></div>
		</div>
</body>
</html>