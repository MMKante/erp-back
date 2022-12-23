<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= $title ?></h3>
		<button class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#modal-add">Add <i class="fa-solid fa-plus"></i></button>
	</div>
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Date</th>
					<th>Product</th>
					<th>Operation type</th>
					<th>Quantity</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($operations as $operation) { ?>
					<tr>
						<td><?= $operation['OperationDate'] ?></td>
						<td><?= $operation['ProductName'] ?></td>
						<td><?= $operation['OperationType'] ?></td>
						<td><?= $operation['Quantity'] ?></td>
						<td>
							<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-update-<?= $operation['RefOperation'] ?>"><i class="fa fa-edit"></i></a>
							<a href="/product-operation/delete/<?= $operation['RefOperation'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are sure?')"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add product</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/product-operation/add" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="date">Date</label>
						<input id="date" name="date" type="date" class="form-control" placeholder="Date..." required />
					</div>
					<div class="form-group">
						<label for="product">Product</label>
						<select id="product" name="product" class="form-control" required>
							<option value="">Product</option>
							<?php foreach ($products as $product) { ?>
							<option value="<?= $product['RefProduct'] ?>">
								<?= $product['Article'].' | '.$product['Name'] ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="operation_type">Operation type</label>
						<select id="operation_type" name="operation_type" class="form-control" required>
							<option value="">Operation type</option>
							<?php foreach ($operationTypes as $operationType) { ?>
							<option value="<?= $operationType['RefOperationType'] ?>">
								<?= $operationType['OperationType'] ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity..." required />
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-primary">Enrégistrer</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($operations as $operation) { ?>
<div class="modal fade" id="modal-update-<?= $operation['RefOperation'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update product</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/product-operation/update/<?= $operation['RefOperation'] ?>" method="POST">
				<div class="modal-body">
				<div class="form-group">
					<label for="date">Date</label>
					<input id="date" name="date" type="date" class="form-control" placeholder="Date..." value="<?= $operation['Date'] ?>" required />
				</div>
				<div class="form-group">
					<label for="product">Product</label>
					<select id="product" name="product" class="form-control" required>
						<option value="">Product</option>
						<?php foreach ($products as $product) { ?>
						<option value="<?= $product['RefProduct'] ?>" <?= ($operation['RefProduct']==$product['RefProduct'])?'selected':'' ?>>
							<?= $product['Article'].' | '.$product['Name'] ?>
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="operation_type">Operation type</label>
					<select id="operation_type" name="operation_type" class="form-control" required>
						<option value="">Operation type</option>
						<?php foreach ($operationTypes as $operationType) { ?>
						<option value="<?= $operationType['RefOperationType'] ?>" <?= ($operation['RefOperationType']==$operationType['RefOperationType'])?'selected':'' ?>>
							<?= $operationType['OperationType'] ?>
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="quantity">Quantity</label>
					<input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity..." value="<?= $operation['Quantity'] ?>" required />
				</div>
			</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-primary">Enrégistrer</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>