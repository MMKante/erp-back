<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= (isset($title))? 'ERP | ' . $title: 'ERP' ?></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="/Assets/css/adminlte.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="https//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		<?= $header ?>
		
		<?= $sidebar ?>

		<div class="content-wrapper">
			<div class="content">
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1><?= $title ?></h1>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>
				<?= $content ?>
			</div>
		</div>
		<?= $footer ?>
	</div>

	<script src="/Assets/js/jquery.min.js"></script>
	<script src="/Assets/js/bootstrap.bundle.min.js"></script>
	<script src="/Assets/js/adminlte.min.js"></script>

	<!-- DataTables -->
	<style>
		#data-table_length {
			float: left;
		}
		.dataTables_filter {
			float: right;
		}
		.paginate_button {
			padding: 4px 8px;
			border: 1px solid black;
			margin: 0 4px;
			border-radius: 4px;
			cursor: pointer;
			background-color: #f8f9fa;
			border-color: #ddd;
			color: #444;
		}
		.dataTables_info {
			float: left;
		}
		.paging_simple_numbers {
			float: right;
		}
	</style>

	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready( function () {
			$('#data-table').DataTable({
				language: {
					url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/ru.json'
				}
			});
		} );
	</script>
</body>
</html>