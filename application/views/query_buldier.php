<div class="row">
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<h3>Query generator</h3>
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="autoQuery"> AutoQuery
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="well col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<input type="text" class="form-control variable finder" placeholder="Variable Search">
		<ul id="variable_conteiner" class="connectedSortable">
		</ul>
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" id="tools" style="max-width: ">
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="row">
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<label>Seleccion de tabla</label>
						<select class="form-control" id="tables">
							<?php foreach ($tables as $key => $table): ?>
								<option value="<?php echo $table->name ?>" <?php echo $table->name==='hawconlinev8_0_1'?'selected':'' ?>><?php echo $table->name ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<button type="button" class="btn btn-primary runQuery" id="runQuery">runQuery</button>
					</div>
				</div>
				<div class="row">
					<h3 class="panel-title">Query</h3>
					<div id="querySample">
						<div class="selector">
							<div>SELECT</div>
							<div class="queryPart" contenteditable="true">*</div>
						</div>
						<div class="from">
							<div>FROM</div>
							<div class="queryPart">hawconlineV8_0_1</div>
						</div>
						<div class="where">
							<div>WHERE</div>
							<div class="queryPart">1=1</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<table class="table table-striped table-bordered table-hover " width="100%" id="propertiesEditor">
					<thead>
						<th></th>
						<th>Valor</th>
						<th>Operator</th>
						<th>Variable</th>
						<th>Operator</th>
						<th>Valor</th>
					</thead>
					<tbody id="tbody">
						<tr id="default" style="display: none">
							<td>
								<span class="btn btn-danger delete"><i class="glyphicon glyphicon-minus"></i> </span>
							</td>
							<td>
								<input disabled="disabled" type="number"  step='0.1' placeholder="[1,∞]"  class="left form-control" name=""></td>
							<td>
								<select class="left form-control">
									<option value="-1"></option>
									<option value="<"><</option>
									<option value="<="><=</option>
								</select>
							</td>
							<td class="variable"></td>
							<td>
								<select class="right form-control">
									<option value="<"><</option>
									<option value="<="><=</option>
									<option value=">">></option>
									<option value=">=">>=</option>
									<option value="!=">!=</option>
									<option value="=">=</option>
								</select>
							</td>
							<td>
								<input type="number" step='0.1' placeholder="[1,∞]"  name="" class="right form-control">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" id="helio" style="overflow: scroll">
			<table class="table" id="responseQuery">
				<thead></thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>