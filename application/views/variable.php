<h3>Variable editor</h3>
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>id_var</th>
					<th>name</th>
					<th>description</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($variables as $key => $var): ?>
				<tr>
					<td><?php echo $var->id_var ?></td>
					<td><?php echo $var->name ?></td>
					<td><?php echo $var->description ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>