<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: right">
		<button type="button" class="btn btn-primary" id="cleanquery">Clean</button>
		<button type="button" class="btn btn-primary runQuery" id="runQuery">Run</button>
		<button type="button" class="btn btn-primary" id="save_context">Save</button>
		<button type="button" class="btn btn-primary" onclick="document.getElementById('fileID').click(); return false;" id="load_context">Load</button>
		<button type="button" class="btn btn-primary " id="saveQuery">Save SQL query</button>
		<button type="button" class="btn btn-primary getcsv" id="getcsv">export results CSV</button>
		<input type="file" id="fileID" style="visibility: hidden;" />
	</div>
</div>

<div class="row">
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<div class="row">
			<label>Table Select</label>
			<select class="form-control" id="tables">
				<?php foreach ($tables as $key => $table): ?>
					<option value="<?php echo $table->name ?>" <?php echo trim($table->name) ==='hawconlineV8_0_1'?'selected':'' ?>><?php echo $table->name ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="row">
			<label>Variable Finder</label>
			<input type="text" class="form-control variable finder" placeholder="Variable Search">
		</div>
		<div class="row">
			<label>Variable List</label>
			<div style="overflow:scroll; height:600px;">
				<ul id="variable_conteiner" class="connectedSortable">
				</ul>
			</div>
		</div>
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"  style="max-width: ">
		<div class="row">
				<!-- <input type="text" id="tags" class="form-control"> -->
		</div>
		<div class="row" id="select">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label >Query</label>
				<div id="querySample" style=" border: 1px solid grey; margin-bottom: 5px">
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<div id="selector">
								<div>SELECT</div>
								<div class="queryPart" contenteditable="true">*</div>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<div id="from">
								<div>FROM</div>
								<div class="queryPart">hawconlineV8_0_1</div>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<div id="where">
								<div>WHERE</div>
								<div class="queryPart">1=1</div>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<div id="extras">
								<div class="queryPart" contenteditable="true">/*constraints*/</div>
								<div class="queryPart" contenteditable="true"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="wheres">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table class="table table-striped table-bordered table-hover " width="100%" id="propertiesEditor">
					<thead>
						<th></th>
						<th>Value</th>
						<th>Operator</th>
						<th>Variable</th>
						<th>Operator</th>
						<th>Valor</th>
					</thead>
					<tbody id="tbody">
						<tr id="default" style="display: none">
							<td>
								<span class="btn btn-danger delete"><i class="glyphicon glyphicon-minus"></i> </span>
								<span class="btn btn-default boolean">AND</span>
							</td>
							<td>
								<div style="position: relative;">
									<input disabled="disabled" type="number"  step='0.1' placeholder="[1,∞]"  class="left form-control" name="">
								</div>
							</td>
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
								<div style="position: relative;">
									<input type="number" step='0.1' placeholder="[1,∞]"  name="" class="right form-control">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="row" id="helio" style="overflow: scroll">
				<table class="table" id="responseQuery">
					<thead></thead>
					<tbody></tbody>
				</table>
		</div>
			</div>
	</div>
</div>