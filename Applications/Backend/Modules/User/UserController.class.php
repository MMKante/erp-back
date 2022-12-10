<?php
	namespace Applications\Backend\Modules\User;

	class UserController extends \Library\BackController {
		public function executeLogin(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$_POST = json_decode(file_get_contents('php://input'), true);
				$user = $this->managers
				->getManagerOf('User')
				->login(
					$request->postData('username'),
					$request->postData('password')
				);
				$data = ['isLogged' => (empty($user)?false:true), 'user' => $user];
				$this->page->addVar('data', $data);
			} else {
				$this->app()->httpResponse()->redirect404();
			}
		}
		public function executeChangeUsername(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$_POST = json_decode(file_get_contents('php://input'), true);
				$userManager = $this->managers->getManagerOf('User');
				
				$user = $userManager->login(
					$request->postData('username'),
					$request->postData('password')
				);
				if (empty($user)) {
					$data = [
						'verified' => false,
						'message' => 'Les identifiants sont incorrects !',
					];
				} else {
					$userManager->setUsername(
						$user['RefUser'],
						$request->postData('new_username'),
					);
					$data = [
						'verified' => true,
						'message' => 'Le username a bien été modifié !'
					];
				}
				$this->page->addVar('data', $data);
			} else {
				$this->app()->httpResponse()->redirect404();
			}
		}
		public function executeChangePassword(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$_POST = json_decode(file_get_contents('php://input'), true);
				$userManager = $this->managers->getManagerOf('User');
				
				$user = $userManager->login(
					$request->postData('username'),
					$request->postData('password')
				);
				if (empty($user)) {
					$data = [
						'verified' => false,
						'message' => 'Les identifiants sont incorrects !',
					];
				} else {
					$userManager->setPassword(
						$user['RefUser'],
						$request->postData('new_password'),
					);
					$data = [
						'verified' => true,
						'message' => 'Le password a bien été modifié !'
					];
				}
				$this->page->addVar('data', $data);
			} else {
				$this->app()->httpResponse()->redirect404();
			}
		}
		public function executeDepartmentList(\Library\HTTPRequest $request) {
			$departments = $this->managers->getManagerOf('User')->departments();

			$this->page->addVar('departments', $departments);
		}
		public function executeAddSupervisor(\Library\HTTPRequest $request) {
			// $departments = $this->managers->getManagerOf('User')->addSupervisor();

			$data = [
				'verified' => true,
				'message' => 'Superviseur créé avec succès !'
			];
			$this->page->addVar('departments', $departments);
		}
	}