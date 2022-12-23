<?php
	namespace Applications\ERP\Modules\ProductOperation;

	class ProductOperationController extends \Library\BackController {
		public function executeList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Liste des operation product');

			$operations = $this->managers->getManagerOf('ProductStockOperation')->list();
			$products = $this->managers->getManagerOf('Product')->list();
			$operationTypes = $this->managers->getManagerOf('ProductStockOperation')->operationTypes();

			foreach ($operations as $key => $operation) {
				$operations[$key]['OperationDate'] = date('d.m.Y', strtotime($operation['Date']));
				$operations[$key]['ProductName'] = $operation['Article'].' | '.$operation['Name'];
			}

			$this->page->addVar('operations', $operations);
			$this->page->addVar('products', $products);
			$this->page->addVar('operationTypes', $operationTypes);
		}
		public function executeAdd(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('ProductStockOperation')->add(
					$request->postData('date'),
					$request->postData('product'),
					$request->postData('operation_type'),
					$request->postData('quantity')
				);
				$this->app->httpResponse()->redirect('/product-operation/list');
			}
		}
		public function executeUpdate(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('ProductStockOperation')->update(
					$request->getData('id'),
					$request->postData('date'),
					$request->postData('product'),
					$request->postData('operation_type'),
					$request->postData('quantity')
				);
				$this->app->httpResponse()->redirect('/product-operation/list');
			}
		}
		public function executeDelete(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('ProductStockOperation')->delete(
				$request->getData('id')
			);
			$this->app->httpResponse()->redirect('/product-operation/list');
		}
	}