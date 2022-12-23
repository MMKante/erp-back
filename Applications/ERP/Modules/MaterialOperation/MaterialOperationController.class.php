<?php
	namespace Applications\ERP\Modules\MaterialOperation;

	class MaterialOperationController extends \Library\BackController {
		public function executeList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Liste des operation material');

			$operations = $this->managers->getManagerOf('MaterialStockOperation')->list();
			$materials = $this->managers->getManagerOf('Material')->list();
			$operationTypes = $this->managers->getManagerOf('MaterialStockOperation')->operationTypes();

			foreach ($operations as $key => $operation) {
				$operations[$key]['OperationDate'] = date('d.m.Y', strtotime($operation['Date']));
				$operations[$key]['MaterialName'] = $operation['Article'].' | '.$operation['Name'];
			}

			$this->page->addVar('operations', $operations);
			$this->page->addVar('materials', $materials);
			$this->page->addVar('operationTypes', $operationTypes);
		}
		public function executeAdd(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('MaterialStockOperation')->add(
					$request->postData('date'),
					$request->postData('material'),
					$request->postData('operation_type'),
					$request->postData('quantity')
				);
				$this->app->httpResponse()->redirect('/material-operation/list');
			}
		}
		public function executeUpdate(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('MaterialStockOperation')->update(
					$request->getData('id'),
					$request->postData('date'),
					$request->postData('material'),
					$request->postData('operation_type'),
					$request->postData('quantity')
				);
				$this->app->httpResponse()->redirect('/material-operation/list');
			}
		}
		public function executeDelete(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('MaterialStockOperation')->delete(
				$request->getData('id')
			);
			$this->app->httpResponse()->redirect('/material-operation/list');
		}
	}