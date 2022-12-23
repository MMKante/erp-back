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
					<th>Name</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($steps as $step) { ?>
				<tr>
					<td><?= $step['Step'] ?></td>
					<td><?= $step['Status'] ?></td>
					<td>
						<?php if ($step['isCompleted']==0 && $user->getAttribute('departmentID')!=2) { ?>
						<a href="/production/step/complete/<?= $step['RefOrder'] ?>/<?= $step['RefStep'] ?>" class="btn btn-sm btn-default"><i class="fa fa-check"></i></a>
						<?php } ?>
						<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-content-<?= $step['RefStep'] ?>"><i class="fa-solid fa-folder-plus"></i></a>
						<?php if ($user->getAttribute('departmentID') != 2) { ?>
						<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-update-<?= $step['RefStep'] ?>"><i class="fa fa-edit"></i></a>
						<a href="/production/step/delete/<?= $step['RefOrder'] ?>/<?= $step['RefStep'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are sure?')"><i class="fa fa-trash"></i></a>
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
				<h4 class="modal-title">Add step</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/production/step/add/<?= $orderID; ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="step">Step</label>
						<input id="step" name="step" type="text" class="form-control" placeholder="Step..." required />
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

<?php foreach ($steps as $step) { ?>
<div class="modal fade" id="modal-update-<?= $step['RefStep'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update step</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/production/step/update/<?= $orderID; ?>/<?= $step['RefStep'] ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="step">Step</label>
						<input id="step" name="step" type="text" class="form-control" placeholder="Step..." value="<?= $step['Step'] ?>" required />
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

<?php
	$techmaps = $manager->technologicalMapList($step['RefStep']);
?>
<div class="modal fade" id="modal-content-<?= $step['RefStep'] ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Technological map</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/production/techmap/add/<?= $orderID; ?>/<?= $step['RefStep'] ?>" method="POST">
				<div class="modal-body">
					<table class="table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Material</th>
								<th>Quantity</th>
								<?php if ($user->getAttribute('departmentID') != 2) { ?>
								<th>Actions</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($techmaps as $techmap) { ?>
							<tr>
								<td><?= $techmap['DateFormated'] ?></td>
								<td><?= $techmap['MaterialName'] ?></td>
								<td><?= $techmap['Quantity'] ?></td>
								<?php if ($user->getAttribute('departmentID') != 2) { ?>
								<td>
									<a href="/production/techmap/delete/<?= $orderID; ?>/<?= $techmap['RefTechnologicalMap'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
								</td>
								<?php } ?>
							</tr>	
						<?php } ?>
						</tbody>
					</table>

					<?php if ($user->getAttribute('departmentID') != 2) { ?>
					<hr>

					<div class="row">
						<div class="col-md-4">
							<label for="date">Date</label>
							<input id="date" name="date" type="date" class="form-control" placeholder="Step..." required />
						</div>
						<div class="col-md-4">
							<label for="material">Material</label>
							<select id="material" name="material" class="form-control" required>
								<option value="">Material</option>
								<?php foreach($materials as $material) { ?>
								<option value="<?= $material['RefMaterial'] ?>">
									<?= $material['Article'].' | '.$material['Name'] ?>
								</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="quantity">Quantity</label>
							<input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity..." required />
						</div>
					</div>
					<?php } ?>
				</div>
				<?php if ($user->getAttribute('departmentID') != 2) { ?>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-primary">Enrégistrer</button>
				</div>
				<?php } ?>
			</form>
		</div>
	</div>
</div>
<?php } ?>