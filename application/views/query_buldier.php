<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h3>Query generator</h3>
	</div>
</div>
<div class="row">

	<div class="well col-xs-3 col-sm-3 col-md-3 col-lg-3">
<!-- 		<div class="panel panel-default">
			<div class="panel-heading">Panel heading without title</div>
			<div class="panel-body">
			</div>
		</div>
 -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Variable Selection</h3>
			</div>
			<div class="panel-body overflow">
				<input class="form-control variable finder">
				<ul id="variable_conteiner" class="connectedSortable">

				</ul>
			</div>
		</div>
	</div>
	<div class="well col-xs-3 col-sm-3 col-md-3 col-lg-3" style="background-color: blue; height: 100%">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Query Building</h3>
			</div>
			<div class="panel-body">
				<ul id="queryBuldier" class="connectedSortable">

				</ul>
			</div>
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="tools" style="height: 100%">
		<div class="row">
			<div class="btn-group">
				<a data-tooltip="tooltip" title="New Propertie" class="btn btn-primary"  href="#"><i class="glyphicon glyphicon-plus"></i></a>
				<a class="btn btn-white"  href="#">New Propertie</a>
			</div>
		</div>
		<div class="row">
			<table class="table table-striped table-bordered table-hover " id="propertiesEditor">
				<thead>

					<th>Valor</th>
					<th>Operator</th>
					<th>Variable</th>
					<th>Operator</th>
					<th>Valor</th>
				</thead>
				<tbody>
					<tr>

						<td><input type="number"  step='0.1' min="10" max='100' placeholder="[1,100]" value="-1" name=""></td>
						<td><select>
							<option value="-1"></option>
							<option><</option>
							<option><=</option>
						</select></td>
						<td class="variable"></td>
						<td><select>
							<option><</option>
							<option><=</option>
							<option>!=</option>
							<option>=</option>
						</select></td>
						<td><input type="number" step='0.1' min="10" max='100' placeholder="[1,100]" value="100" name=""></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>