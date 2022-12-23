<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= (isset($title))? 'ERP | ' . $title: 'ERP' ?></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="/Assets/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
	<?= $content ?>
	

	<script src="/Assets/js/jquery.min.js"></script>
	<script src="/Assets/js/bootstrap.bundle.min.js"></script>
	<script src="/Assets/js/adminlte.min.js"></script>
</body>
</html>
