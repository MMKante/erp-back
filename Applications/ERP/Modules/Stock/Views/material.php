<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= $title ?></h3>
	</div>
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Article</th>
					<th>Name</th>
					<th>Unity</th>
					<th>Cost</th>
					<th>Stock</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($materials as $material) { ?>
					<tr>
						<td><?= $material['Article'] ?></td>
						<td><?= $material['Name'] ?></td>
						<td><?= $material['Unity'] ?></td>
						<td><?= $material['Cost'] ?></td>
						<td><?= $material['Stock'] ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>