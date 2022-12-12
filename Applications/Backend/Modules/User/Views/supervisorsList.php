<?php
	$data = [];

	foreach ($supervisors as $key => $supervisor) {
		$data[] = [
			'id' => $supervisor['RefSupervisor'],
			'firstname' => $supervisor['Firstname'],
			'lastname' => $supervisor['Lastname'],
			'phone' => $supervisor['Phone'],
			'email' => $supervisor['Email'],
			'department' => $supervisor['Department']
		];
	}

	echo json_encode($data);