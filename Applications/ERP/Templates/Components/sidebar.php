<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="index3.html" class="brand-link">
		<span class="brand-text font-weight-light">ERP</span>
	</a>
	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="info text-light">
				<i class="fa-solid fa-circle-user"></i>
			</div>
			<div class="info">
				<a href="/profile" class="d-block"><?= $user->getAttribute('firstname'). ' ' .$user->getAttribute('lastname') ?></a>
			</div>
		</div>
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="/" class="nav-link">
						<i class="nav-icon fa-solid fa-industry"></i>
						<p>Главная</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/production/list" class="nav-link">
						<i class="nav-icon fa-solid fa-industry"></i>
						<p>Производства</p>
					</a>
				</li>
				<?php if (in_array($user->getAttribute('departmentID'), [0, 1])) { ?>
				<li class="nav-item">
					<a href="/stock/product" class="nav-link">
						<i class="nav-icon fa-solid fa-cube"></i>
						<p>Запас ГП</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/stock/material" class="nav-link">
						<i class="nav-icon fa-solid fa-cube"></i>
						<p>Запас материалов</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/product-operation/list" class="nav-link">
						<i class="nav-icon fa-solid fa-arrow-down-up-across-line"></i>
						<p>Готовые продукции</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/material-operation/list" class="nav-link">
						<i class="nav-icon fa-solid fa-arrow-down-up-across-line"></i>
						<p>Материалы</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/product/list" class="nav-link">
						<i class="nav-icon fa-solid fa-tag"></i>
						<p>Готовые продукции</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/material/list" class="nav-link">
						<i class="nav-icon fa-solid fa-tag"></i>
						<p>Материалы</p>
					</a>
				</li>
				<?php } ?>
				<?php if ($user->getAttribute('departmentID') == 0) { ?>
				<li class="nav-item">
					<a href="/supervisor/list" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>Пользователи</p>
					</a>
				</li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</aside>