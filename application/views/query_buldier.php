<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h3>Query generator</h3>
	</div>
</div>
<div class="row">

	<div class="well col-xs-3 col-sm-3 col-md-3 col-lg-3">
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
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="tools">
		<table class="table table-striped table-bordered table-hover " id="propertiesEditor">
			<thead>

				<th>Valor</th>
				<th>Operator</th>
				<th>Variable</th>
				<th>Operator</th>
				<th>Valor</th>
			</thead>
			<tbody id="tbody">
				<tr id="default" style="display: none">
					<td>
						<input disabled="disabled" type="number"  step='0.1' min="10" max='100' placeholder="[1,100]" value="-1" class="left" name=""></td>
					<td>
						<select class="left">
							<option value="-1"></option>
							<option value="<"><</option>
							<option value="<="><=</option>
						</select>
					</td>
					<td class="variable"></td>
					<td>
						<select class="rigth">
							<option value="<"><</option>
							<option value="<="><=</option>
							<option value="!=">!=</option>
							<option value="=">=</option>
						</select>
					</td>
					<td><input type="number" step='0.1' min="10" max='100' placeholder="[1,100]" value="100" name="" class="rigth"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		<h3 class="panel-title">Query</h3>
		<div id="querySample">
				<div class="selector">
					<div>SELECT</div>
					<div class="queryPart">File_name</div>
				</div>
				<div class="from">
					<div>FROM</div>
					<div class="queryPart">hawconlinev8_0_1</div>
				</div>
				<div class="where">
					<div>WHERE</div>
				</div>
		</div>
	</div>
</div>
