<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= $title ?></h3>
		<button class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#modal-add">Добавить <i class="fa-solid fa-plus"></i></button>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Имя</th>
					<th>Фамилия</th>
					<th>Электронная почта</th>
					<th>Телефон</th>
					<th>Отдел</th>
					<th>Статус</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($supervisors as $supervisor) { ?>
					<tr>
						<td><?= $supervisor['Firstname'] ?></td>
						<td><?= $supervisor['Lastname'] ?></td>
						<td><?= $supervisor['Email'] ?></td>
						<td><?= $supervisor['Phone'] ?></td>
						<td><?= $supervisor['Department'] ?></td>
						<td><?= ($supervisor['isActive'] == 1)? 'Активировано': ((is_numeric($supervisor['isActive']) && $supervisor['isActive']==0)? 'Деактивировано' : 'Нет идентификаторов') ?></td>
						<td>
							<?php if (is_numeric($supervisor['isActive'])) { ?>
							<a href="/supervisor/status/<?= $supervisor['RefSupervisor'] ?>/<?= $supervisor['isActive'] ?>" class="btn btn-sm btn-default"><i class="fa-solid fa-toggle-on"></i></a>
							<?php } ?>
							<a href="#" data-toggle="modal" data-target="#set-pass-<?= $supervisor['RefSupervisor'] ?>" class="btn btn-sm btn-default"><i class="fa fa-lock"></i></a>
							<a href="#" data-toggle="modal" data-target="#modal-update-<?= $supervisor['RefSupervisor'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
							<a href="/supervisor/delete/<?= $supervisor['RefSupervisor'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are sure?')"><i class="fa fa-trash"></i></a>
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
				<h4 class="modal-title">Добавление пользователя</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/supervisor/add" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="firstname">Имя</label>
						<input id="firstname" name="firstname" type="text" class="form-control" placeholder="Имя..." required />
					</div>
					<div class="form-group">
						<label for="lastname">Фамилия</label>
						<input id="lastname" name="lastname" type="text" class="form-control" placeholder="Фамилия..." required />
					</div>
					<div class="form-group">
						<label for="email">Электронная почта</label>
						<input id="email" name="email" type="email" class="form-control" placeholder="Электронная почта..." required />
					</div>
					<div class="form-group">
						<label for="phone">Телефон</label>
						<input id="phone" name="phone" type="text" class="form-control" placeholder="Телефон..." required />
					</div>
					<div class="form-group">
						<label for="department">Отдел</label>
						<select id="department" name="department" class="form-control" required> 
							<option value="">Отдел</option>
							<?php foreach($departments as $department) { ?>
								<option value="<?= $department['RefDepartment'] ?>"><?= $department['Department'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($supervisors as $supervisor) { ?>
<div class="modal fade" id="modal-update-<?= $supervisor['RefSupervisor'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Изменение пользователя</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/supervisor/update/<?= $supervisor['RefSupervisor'] ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="firstname">Имя</label>
						<input id="firstname" name="firstname" type="text" class="form-control" placeholder="Имя..." value="<?= $supervisor['Firstname'] ?>" required />
					</div>
					<div class="form-group">
						<label for="lastname">Фамилия</label>
						<input id="lastname" name="lastname" type="text" class="form-control" placeholder="Фамилия..." value="<?= $supervisor['Lastname'] ?>" required />
					</div>
					<div class="form-group">
						<label for="email">Электронная почта</label>
						<input id="email" name="email" type="email" class="form-control" placeholder="Электронная почта..." value="<?= $supervisor['Email'] ?>" required />
					</div>
					<div class="form-group">
						<label for="phone">Телефон</label>
						<input id="phone" name="phone" type="text" class="form-control" placeholder="Телефон..." value="<?= $supervisor['Phone'] ?>" required />
					</div>
					<div class="form-group">
						<label for="department">Отдел</label>
						<select id="department" name="department" class="form-control" required> 
							<option value="">Отдел</option>
							<?php foreach($departments as $department) { ?>
								<option value="<?= $department['RefDepartment'] ?>" <?= ($department['RefDepartment'] == $supervisor['RefDepartment'])? 'selected':'' ?>><?= $department['Department'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="set-pass-<?= $supervisor['RefSupervisor'] ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Информация для входа</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/supervisor/set-pass/<?= $supervisor['RefSupervisor'] ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="username">Логин</label>
						<input id="username" name="username" type="text" class="form-control" placeholder="Логин..." required />
					</div>
					<div class="form-group">
						<label for="password">Пароль</label>
						<input id="password" name="password" type="password" class="form-control" placeholder="Пароль..." required />
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>