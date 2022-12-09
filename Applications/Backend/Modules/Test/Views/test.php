<?php
	$array = [];
	foreach ($data as $line) {
		$array[] = [
			'id' => $line['id'],
			'title' => $line['title'],
			'genre' => $line['genre'],
			'platform' => $line['platform'],
			'publisher' => $line['publisher'],
			'developer' => $line['developer'],
			'release_date' => $line['release_date']
		];
	}
	// echo "<pre>";
	// print_r($array);
	// print_r(json_encode($array));
	// echo "</pre>";
	echo json_encode($array);