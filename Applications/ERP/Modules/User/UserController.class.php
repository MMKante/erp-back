<?php
	namespace Applications\ERP\Modules\User;

	class UserController extends \Library\BackController {
		public function executeLogin(\Library\HTTPRequest $request) {
			$this->page()->setTemplate('login');
			if ($request->method() == 'POST') {
				$user = $this->managers
				->getManagerOf('User')
				->login(
					$request->postData('username'),
					$request->postData('password')
				);
				if (empty($user)) {
					$this->app->user()->setFlash('Неверная информация! Попробуйте еще раз...');
				} else {
					$this->app->user()->setAuthenticated();
					$this->app->user()->setAttribute('firstname', $user['Firstname']);
					$this->app->user()->setAttribute('lastname', $user['Lastname']);
					$this->app->user()->setAttribute('supervisorID', $user['RefSupervisor']);
					$this->app->user()->setAttribute('departmentID', $user['RefDepartment']);
					$this->app->httpResponse()->redirect('/');
				}
			}
		}
		public function executeLogout(\Library\HTTPRequest $request) {
			$this->app->user()->setAuthenticated(false);
			session_destroy();
			$this->app->httpResponse()->redirect('/');
		}
		public function executeChangeUsername(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('User')->setUsername(
					$this->app->user()->getAttribute('supervisorID'),
					$request->postData('username'),
				);
				$this->app->httpResponse()->redirect('/profile');
			}
		}
		public function executeChangePassword(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				if ($request->postData('password') === $request->postData('conf_password')) {
					$this->managers->getManagerOf('User')->setPassword(
						$this->app->user()->getAttribute('supervisorID'),
						$request->postData('password'),
					);
					$message = [
						'type' => 'success',
						'message' => 'Пароль успешно изменен!'
					];
				} else {
					$message = [
						'type' => 'danger',
						'message' => 'Пароль и подтверждающий пароль не совпадают!'
					];
				}
			}
			$this->app->user()->setFlash($message);
			$this->app->httpResponse()->redirect('/profile');	
		}
		public function executeAddSupervisor(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('User')->addSupervisor(
				$request->postData('firstname'),
				$request->postData('lastname'),
				$request->postData('email'),
				$request->postData('phone'),
				$request->postData('department')
			);
			$this->app->httpResponse()->redirect('/supervisor/list');
		}
		public function executeSupervisorsList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Список пользователей');

			$supervisors = $this->managers->getManagerOf('User')->supervisors();
			$departments = $this->managers->getManagerOf('Department')->list();

			$this->page->addVar('supervisors', $supervisors);
			$this->page->addVar('departments', $departments);
		}
		public function executeDeleteSupervisor(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('User')->deleteSupervisor($request->getData('id'));

			$this->app->httpResponse()->redirect('/supervisor/list');
		}
		public function executeUpdateSupervisor(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('User')->updateSupervisor(
				$request->getData('id'),
				$request->postData('firstname'),
				$request->postData('lastname'),
				$request->postData('email'),
				$request->postData('phone'),
				$request->postData('department')
			);
			$this->app->httpResponse()->redirect('/supervisor/list');
		}
		public function executeSetPassSupervisor(\Library\HttpRequest $request) {
			$this->managers->getManagerOf('User')->setPassSupervisor(
				$request->getData('id'),
				$request->postData('username'),
				$request->postData('password')
			);

			$this->app->httpResponse()->redirect('/supervisor/list');
		}
		public function executeSetStatus(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('User')->setStatus(
				$request->getData('id'),
				($request->getData('status') +1)%2
			);

			$this->app->httpResponse()->redirect('/supervisor/list');
		}
		public function executeProfile(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Профиль');

			$supervisor = $this->managers->getManagerOf('User')->supervisor(
				$this->app->user()->getAttribute('supervisorID')
			);

			$this->page->addVar('supervisor', $supervisor);
		}
	}