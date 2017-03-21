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
		<table class="table">
			<thead>
				<tr>
					<th>VariableID</th>
					<th>VariableName</th>
					<th>Name</th>
					<th>Description</th>
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
					<td><input type="text" name="MinRange" class="form-control MinRange" value="<?php echo $var->MinRange ?>"></td>
					<td><input type="text" name="MaxRange" class="form-control MaxRange" value="<?php echo $var->MaxRange ?>"></td>
					<td><input type="text" name="Step" class="form-control Step" value="<?php echo $var->Step ?>"></td>
					<td>
						<button type="button" class="btn save btn-primary">Save</button>
						<!-- <button type="button" class="btn edit btn-success">Editar Rango</button> -->
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">

	var base_url = window.location.origin+"/hawc/index.php/";
	function newVariable() {
		if(
				$(".popover-content form input.name").length >0 &&
				$(".popover-content form input.description").length>0 &&
				$(".popover-content form input.name").val().length > 0 &&
				$(".popover-content form input.description").val().length > 0
			) {
			var newVariable = $(".popover-content form").serialize();
			insertVariable(newVariable)
				.done(function(response){
					if (response.correct) {
						$("#popover").popover('hide');
					}else{
					}
				});
		}
	}

	function insertVariable(data) {
		return $.ajax({
			url: base_url +"~manuel/Hawc/insertVariable",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

</script>