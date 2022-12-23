<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= $title ?></h3>
		<button class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#modal-add">Add <i class="fa-solid fa-plus"></i></button>
	</div>
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Article</th>
					<th>Name</th>
					<th>Unity</th>
					<th>Cost</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($materials as $material) { ?>
					<tr>
						<td><?= $material['Article'] ?></td>
						<td><?= $material['Name'] ?></td>
						<td><?= $material['Unity'] ?></td>
						<td><?= $material['Cost'] ?></td>
						<td>
							<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-update-<?= $material['RefMaterial'] ?>"><i class="fa fa-edit"></i></a>
							<a href="/material/delete/<?= $material['RefMaterial'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are sure?')"><i class="fa fa-trash"></i></a>
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
				<h4 class="modal-title">Add material</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/material/add" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="article">Article</label>
						<input id="article" name="article" type="text" class="form-control" placeholder="Article..." required />
					</div>
					<div class="form-group">
						<label for="name">Name</label>
						<input id="name" name="name" type="text" class="form-control" placeholder="Name..." required />
					</div>
					<div class="form-group">
						<label for="unity">Unity</label>
						<input id="unity" name="unity" type="text" class="form-control" placeholder="Unity..." required />
					</div>
					<div class="form-group">
						<label for="cost">Cost</label>
						<input id="cost" name="cost" type="number" class="form-control" placeholder="Cost..." required />
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

<?php foreach ($materials as $material) { ?>
<div class="modal fade" id="modal-update-<?= $material['RefMaterial'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update material</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/material/update/<?= $material['RefMaterial'] ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="article">Article</label>
						<input id="article" name="article" type="text" class="form-control" placeholder="Article..." value="<?= $material['Article'] ?>" required />
					</div>
					<div class="form-group">
						<label for="name">Name</label>
						<input id="name" name="name" type="text" class="form-control" placeholder="Name..." value="<?= $material['Name'] ?>" required />
					</div>
					<div class="form-group">
						<label for="unity">Unity</label>
						<input id="unity" name="unity" type="text" class="form-control" placeholder="Unity..." value="<?= $material['Unity'] ?>" required />
					</div>
					<div class="form-group">
						<label for="cost">Cost</label>
						<input id="cost" name="cost" type="number" class="form-control" placeholder="Cost..." value="<?= $material['Cost'] ?>" required />
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