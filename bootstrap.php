<?php
	try {
		require('Library/autoload.php');

		$app = new \Applications\ERP\ERPApplication;
		$app->run();
	} catch (\Exception $e) {
		die($e->getMessage());
	}