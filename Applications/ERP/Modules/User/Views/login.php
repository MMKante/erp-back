<div class="login-box">
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<a href="../../index2.html" class="h1"><b>ERP</b></a>
		</div>
		<div class="card-body">
			<p class="login-box-msg">Введите свои данные для входа в систему...</p>

			<?php if ($user->hasFlash()) { ?>
			<div class="alert alert-danger">
				<?= $user->getFlash(); ?>
			</div>
			<?php } ?>

			<form method="POST">
				<div class="input-group mb-3">
					<input name="username" type="text" class="form-control" placeholder="Имя пользователя...">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input name="password" type="password" class="form-control" placeholder="Пароль...">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">Войти</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>