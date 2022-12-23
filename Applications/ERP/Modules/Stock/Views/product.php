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
				<?php foreach ($products as $product) { ?>
					<tr>
						<td><?= $product['Article'] ?></td>
						<td><?= $product['Name'] ?></td>
						<td><?= $product['Unity'] ?></td>
						<td><?= $product['Cost'] ?></td>
						<td><?= $product['Stock'] ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>