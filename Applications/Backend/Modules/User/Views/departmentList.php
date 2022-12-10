<?php
	$data = [];

	foreach ($departments as $key => $department) {
		$data[] = [
			'id' => $department['RefDepartment'],
			'value' => $department['Department']
		];
	}

	echo json_encode($data);