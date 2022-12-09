<?php
	namespace Applications\Backend\Modules\Test;

	class TestController extends \Library\BackController {
		public function executeTest(\Library\HTTPRequest $request) {
			$data = file_get_contents('https://www.freetogame.com/api/games');
			$this->page->addVar('data', json_decode($data, true));
		}
	}