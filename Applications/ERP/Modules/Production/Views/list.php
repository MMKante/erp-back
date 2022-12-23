<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= $title ?></h3>
		<?php if ($user->getAttribute('departmentID') != 2) { ?>
		<button class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#modal-add">Add <i class="fa-solid fa-plus"></i></button>
		<?php } ?>
	</div>
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Number</th>
					<th>Date</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Arrival date</th>
					<th>Is production good?</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($productions as $production) { ?>
					<tr>
						<td><?= $production['Number'] ?></td>
						<td><?= $production['DateFormated'] ?></td>
						<td><?= $production['ProductArticle'].' | '.$production['ProductName'] ?></td>
						<td><?= $production['Quantity'] ?></td>
						<td><?= $production['ArrivalDateFormated'] ?></td>
						<td><?= $production['ProductionStatut'] ?></td>
						<td>
							<a href="/production/step/<?= $production['RefOrder'] ?>" class="btn btn-sm btn-default"><i class="fa-solid fa-folder-plus"></i></a>
							<?php if ($user->getAttribute('departmentID') != 2) { ?>
							<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-update-<?= $production['RefOrder'] ?>"><i class="fa fa-edit"></i></a>
							<a href="/production/delete/<?= $production['RefOrder'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are sure?')"><i class="fa fa-trash"></i></a>
							<?php } elseif (
								$user->getAttribute('departmentID') == 2 && 
								$production['isProductionGood'] === NULL
							) { ?>
							<a href="/production/set-good/<?= $production['RefOrder'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Are sure?')">
								<i class="fa fa-check"></i>
							</a>
							<a href="/production/set-bad/<?= $production['RefOrder'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are sure?')">
								<i class="fa fa-cancel"></i>
							</a>
							<?php } ?>
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
				<h4 class="modal-title">Add production</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/production/add" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="number">Number</label>
						<input id="number" name="number" type="number" class="form-control" placeholder="Number..." required />
					</div>
					<div class="form-group">
						<label for="date">Date</label>
						<input id="date" name="date" type="date" class="form-control" placeholder="Date..." required />
					</div>

					<div class="form-group">
						<label for="product">Product</label>
						<select id="product" name="product" class="form-control" required>
							<option value="">Product</option>
							<?php foreach ($products as $product) { ?>
							<option value="<?= $product['RefProduct'] ?>"><?= $product['Article'].' '.$product['Name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity..." required />
					</div>
					<div class="form-group">
						<label for="arrival_date">Arrival date</label>
						<input id="arrival_date" name="arrival_date" type="date" class="form-control" placeholder="Arrival date..." required />
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

<?php foreach ($productions as $production) { ?>
<div class="modal fade" id="modal-update-<?= $production['RefOrder'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add production</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/production/update/<?= $production['RefOrder'] ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="number">Number</label>
						<input id="number" name="number" type="number" class="form-control" placeholder="Number..." value="<?= $production['Number'] ?>" required />
					</div>
					<div class="form-group">
						<label for="date">Date</label>
						<input id="date" name="date" type="date" class="form-control" placeholder="Date..." value="<?= $production['Date'] ?>" required />
					</div>
					<div class="form-group">
						<label for="product">Product</label>
						<select id="product" name="product" class="form-control" required>
							<option value="">Product</option>
							<?php foreach ($products as $product) { ?>
							<option value="<?= $product['RefProduct'] ?>" <?= ($product['RefProduct']==$production['RefProduct'])?'selected':'' ?>><?= $product['Article'].' '.$product['Name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity..." value="<?= $production['Quantity'] ?>" required />
					</div>
					<div class="form-group">
						<label for="arrival_date">Arrival date <?= $production['ArrivalDate'] ?></label>
						<input id="arrival_date" name="arrival_date" type="date" class="form-control" placeholder="Arrival date..." value="<?= $production['ArrivalDate'] ?>" required />
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