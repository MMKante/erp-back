<?php
	$data = [];
	foreach ($products as $product) {
		$data[] = [
			'id' => $product['RefProduct'],
			'title' => $product['Name'],
			'description' => (strlen($product['Description']) <= 100)?$product['Description'] : substr($product['Description'], 0, 80) . '...',
			'price' => $product['Price'],
			'category' => $product['Category'],
			'image' => $product['Image'],
		];
	}

	echo json_encode($data);