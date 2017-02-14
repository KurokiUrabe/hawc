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
					<th>Name</th>
					<th>Description</th>
					<th>Acion</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($variables as $key => $var): ?>
				<tr>
					<td><?php echo $var->VariableID ?></td>
					<td><?php echo $var->Name ?></td>
					<td><span contenteditable="true" class="form-control"><?php echo $var->Description ?></span></td>
					<td>
						<button type="button" class="btn save btn-primary">Save</button>
						<button type="button" class="btn edit btn-success">Editar Rango</button>
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
		console.error("asdas");
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
			url: base_url +"Hawc/insertVariable",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}
</script>