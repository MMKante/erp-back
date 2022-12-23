<div class="row">
	<div class="col-md-3">
		<div class="card card-primary card-outline">
			<div class="card-body box-profile">
				<h3 class="profile-username text-center"><?= $supervisor['Firstname']. ' ' .$supervisor['Lastname'] ?></h3>
				<p class="text-muted text-center"><?= $supervisor['Department'] ?></p>

				<a href="/profile/change-username" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-username"><b>Change username</b></a>
				<a href="/profile/change-password" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-password"><b>Change password</b></a>
			</div>
		</div>
	</div>

	<?php if ($user->hasFlash()) { $message = $user->getFlash(); ?>
	<div class="col-md-9">
		<div class="alert alert-<?= $message['type'] ?>">
			<?= $message['message'] ?>
		</div>
	</div>
	<?php } ?>
</div>

<div class="modal fade" id="modal-username">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Change username</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/profile/change-username" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="username">New username</label>
						<input id="username" name="username" type="text" class="form-control" placeholder="Username..." required />
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

<div class="modal fade" id="modal-password">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Change password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/profile/change-password" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="password">New password</label>
						<input id="password" name="password" type="password" class="form-control" placeholder="New password..." required />
					</div>
					<div class="form-group">
						<label for="conf_password">Confirm new password</label>
						<input id="conf_password" name="conf_password" type="password" class="form-control" placeholder="New password..." required />
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