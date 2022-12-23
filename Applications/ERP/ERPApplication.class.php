<?php
	namespace Applications\ERP;

	use \Applications\ERP\Modules\User\UserController;

	class ERPApplication extends \Library\Application {
		
		public function __construct() {
			parent::__construct();
			$this->name = 'ERP';
		}
		public function run() {
			if ($this->user()->isAuthenticated()) {
				$controller = $this->getController();
			} else {
				$controller = new UserController($this, 'User', 'Login');
			}
			$controller->execute();
			$this->httpResponse->setPage($controller->page());
			$this->httpResponse->send();
		}
	}