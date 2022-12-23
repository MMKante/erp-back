<?php
	namespace Applications\ERP\Modules\Material;

	class MaterialController extends \Library\BackController {
		public function executeList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Liste des materials');

			$this->page->addVar('materials', $this->managers->getManagerOf('Material')->list());
		}
		public function executeAdd(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('Material')->add(
					$request->postData('article'),
					$request->postData('name'),
					$request->postData('unity'),
					$request->postData('cost')
				);
				$this->app->httpResponse()->redirect('/material/list');
			}
		}
		public function executeUpdate(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('Material')->update(
					$request->getData('id'),
					$request->postData('article'),
					$request->postData('name'),
					$request->postData('unity'),
					$request->postData('cost')
				);
				$this->app->httpResponse()->redirect('/material/list');
			}
		}
		public function executeDelete(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('Material')->delete(
				$request->getData('id')
			);
			$this->app->httpResponse()->redirect('/material/list');
		}
	}