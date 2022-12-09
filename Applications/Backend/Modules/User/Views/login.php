<?php
	$user['isLogged'] = $data['isLogged'];
	if ($data['isLogged']) {
		$user['user'] = [
			'username' => $data['user']['Username'],
			'password' => $data['user']['Password'],
			'firstname' => $data['user']['Firstname'],
			'lastname' => $data['user']['Lastname']
		];
	} else {
		$user['user'] = false;
	}

	echo json_encode($user);