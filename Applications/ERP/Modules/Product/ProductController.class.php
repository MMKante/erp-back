<?php
	namespace Applications\ERP\Modules\Product;

	class ProductController extends \Library\BackController {
		public function executeList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Liste des produits');

			$this->page->addVar('products', $this->managers->getManagerOf('Product')->list());
		}
		public function executeAdd(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('Product')->add(
					$request->postData('article'),
					$request->postData('name'),
					$request->postData('unity'),
					$request->postData('cost')
				);
				$this->app->httpResponse()->redirect('/product/list');
			}
		}
		public function executeUpdate(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('Product')->update(
					$request->getData('id'),
					$request->postData('article'),
					$request->postData('name'),
					$request->postData('unity'),
					$request->postData('cost')
				);
				$this->app->httpResponse()->redirect('/product/list');
			}
		}
		public function executeDelete(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('Product')->delete(
				$request->getData('id')
			);
			$this->app->httpResponse()->redirect('/product/list');
		}
	}