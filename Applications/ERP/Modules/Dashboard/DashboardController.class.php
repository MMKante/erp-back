<?php
	namespace Applications\ERP\Modules\Dashboard;

	class DashboardController extends \Library\BackController {
		public function executeIndex(\Library\HttpRequest $request) {
			$this->page->addVar('title', 'Главная');

			$data = $this->managers->getManagerOf('Dashboard')->data();

			$this->page->addVar('data', $data);
		}
	}