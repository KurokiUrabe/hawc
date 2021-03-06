<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>HAWC</title>
	<meta name="description" content="The HTML5 HAWC">
	<meta name="author" content="Manuel">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo asset_url('css/styles.css?v=1.0') ?>">

	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bootstrap 101 Template</title>

	<!-- Bootstrap -->
	<link href="<?php echo asset_url("css/bootstrap.min.css") ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo asset_url('css/bootstrap-datetimepicker.min.css') ?>">
	<script type="text/javascript">
		var baseurl = "<?php echo base_url() ?><?php  ?>";
		var urlBase = "<?php echo site_url('') ?><?php  ?>";
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
				<h1>HAWC <small>Variables</small></h1>
			</div>
				<h3>Variable editor</h3>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="#"  id="popover"  class="btn btn-danger" id="popover">
							<i class="glyphicon glyphicon-plus"></i>
							New Variable</a>
							<div id="popover-head" class="hide">Create a new variable</div>
							<div id="popover-content" class="hide">
								<form>
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control name" name="Name">
									</div>
									<div class="form-group">
										<label>Description</label>
										<input type="text" class="form-control description" name="Description">
									</div>
								</form>
								<div style="text-align: right;">
									<a href="#" id="popoverSave" class="btn btn-success " onClick="newVariable()">Save</a>
								</div>
							</div>
					</div>
				</div>
				<div class="row">
					<table id="VariableTable" class="table">
						<thead>
							<tr>
								<th>VariableID</th>
								<th>VariableName</th>
								<th>Display Name</th>
								<th>Description</th>
								<th>ComponentType</th>
								<th>MinRange</th>
								<th>MaxRange</th>
								<th>Step</th>
								<th>Acion</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($variables as $key => $var): ?>
							<tr>
								<td>
									<?php echo $var->VariableID ?>
									<input type="hidden" name="VariableID" value="<?php echo $var->VariableID ?>" placeholder="<?php echo $var->VariableID ?>">
								</td>
								<td><?php echo $var->VariableName ?></td>
								<td><input type="text" name="name" class="form-control name" value="<?php echo $var->Name ?>" placeholder="<?php echo $var->VariableName ?>"></td>
								<td><input type="text" name="description" class="form-control description" value="<?php echo $var->Description ?>"></td>
								<!-- <td><input type="text" name="Type" class="form-control Type" value="<?php echo $var->Type ?>"></td> -->
								<td>
									<select type="text" name="Type" class="form-control Type">
										<option value="0" <?php echo $var->Type==0?'selected':'' ?> >Float</option>
										<option value="1" <?php echo $var->Type==1?'selected':'' ?> >Date and time</option>
									</select>
								</td>
								<td>
								<div style="position: relative;"><input type="text" name="MinRange" class="form-control MinRange <?php echo $var->Type?'datetimepicker':'' ?>" value="<?php echo $var->Type?date('Y-m-d H:i:s',$var->MinRange): $var->MinRange ?>"></div></td>
								<td><div style="position: relative;"><input type="text" name="MaxRange" class="form-control MaxRange <?php echo $var->Type?'datetimepicker':'' ?>" value="<?php echo $var->Type?date('Y-m-d H:i:s',$var->MaxRange): $var->MaxRange ?>"></div></td>
								<td><input type="text" name="Step" class="form-control Step" value="<?php echo $var->Step ?>"></td>
								<td>
									<button type="button" class="btn save btn-primary">Save</button>
									<!-- <button type="button" class="btn edit btn-success">Editar Rango</button> -->
								</td>
							</tr>
						<?php endforeach ?>
						</tbo	dy>
					</table>
				</div>
			</div>

			<footer class="footer navbar-fixed-bottom">

				<p class="center">the HAWC Collaboration</p>
			</footer>



		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo asset_url("js/bootstrap.min.js") ?>"></script>
		<script src="<?php echo asset_url("js/moment-with-locales.min.js") ?>"></script>
		<script src="<?php echo asset_url("js/bootstrap-datetimepicker.min.js") ?>"></script>
		<script src="<?php echo asset_url("js/scriptVariable.js") ?>"></script>
		<!-- Site footer -->
		<script type="text/javascript">
			// var base_url = window.location.origin+"/hawc/index.php/";
			

		</script>
</body>
</html>