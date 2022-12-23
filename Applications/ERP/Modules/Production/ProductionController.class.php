<?php
	namespace Applications\ERP\Modules\Production;

	class ProductionController extends \Library\BackController {
		public function executeList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Production list');

			$productions = $this->managers->getManagerOf('Production')->list();
			$products = $this->managers->getManagerOf('Product')->list();

			foreach ($productions as $key => $production) {
				$productions[$key]['DateFormated'] = date('d.m.Y', strtotime($production['Date']));
				$productions[$key]['ArrivalDateFormated'] = date('d.m.Y', strtotime($production['ArrivalDate']));
				$productions[$key]['ProductionStatut'] = ($production['isProductionGood'] == 1)? 'Good': (($production['isProductionGood']==2)? 'Not good':'Not verified yet!');
			}

			$this->page->addVar('products', $products);
			$this->page->addVar('productions', $productions);
		}
		public function executeAdd(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('Production')->add(
					$request->postData('number'),
					$request->postData('date'),
					$request->postData('product'),
					$request->postData('quantity'),
					$request->postData('arrival_date'),
					$this->app->user()->getAttribute('supervisorID')
				);
				$this->app->httpResponse()->redirect('/production/list');
			}
		}
		public function executeUpdate(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$this->managers->getManagerOf('Production')->update(
					$request->getData('id'),
					$request->postData('number'),
					$request->postData('date'),
					$request->postData('product'),
					$request->postData('quantity'),
					$request->postData('arrival_date'),
				);
				$this->app->httpResponse()->redirect('/production/list');
			}
		}
		public function executeDelete(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('Production')->delete(
				$request->getData('id')
			);

			$this->app->httpResponse()->redirect('/production/list');
		}
		public function executeStepList(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Realization\'s steps');

			$steps = $this->managers->getManagerOf('Production')->steps(
				$request->getData('id')
			);
			$materials = $this->managers->getManagerOf('Material')->list();
			$orderID = $request->getData('id');

			foreach ($steps as $key => $step) {
				$steps[$key]['Status'] = ($step['isCompleted'] ? 'Completed' : 'In progress');
			}

			$this->page->addVar('steps', $steps);
			$this->page->addVar('materials', $materials);
			$this->page->addVar('manager', $this->managers->getManagerOf('Production'));
			$this->page->addVar('orderID', $orderID);
		}
		public function executeStepAdd(\Library\HTTPRequest $request) {
			if ($request->method() == 'POST') {
				$steps = $this->managers->getManagerOf('Production')->addStep(
					$request->getData('id'),
					$request->postData('step')
				);
				$this->app->httpResponse()->redirect('/production/step/' . $request->getData('id'));
			}
		}
		public function executeStepDelete(\Library\HTTPRequest $request) {
			$steps = $this->managers->getManagerOf('Production')->deleteStep(
				$request->getData('id')
			);
			$this->app->httpResponse()->redirect('/production/step/' . $request->getData('order'));	
		}
		public function executeStepUpdate(\Library\HTTPRequest $request) {
			$steps = $this->managers->getManagerOf('Production')->updateStep(
				$request->getData('id'),
				$request->postData('step')
			);
			$this->app->httpResponse()->redirect('/production/step/' . $request->getData('order'));	
		}
		public function executeStepComplete(\Library\HTTPRequest $request) {
			$steps = $this->managers->getManagerOf('Production')->completeStep(
				$request->getData('id'),
				$request->postData('step')
			);
			$this->app->httpResponse()->redirect('/production/step/' . $request->getData('order'));	
		}
		public function executeTechmapAdd(\Library\HTTPRequest $request) {
			$steps = $this->managers->getManagerOf('Production')->techmapAdd(
				$request->getData('id'),
				$request->postData('date'),
				$request->postData('material'),
				$request->postData('quantity')
			);
			$this->app->httpResponse()->redirect('/production/step/' . $request->getData('order'));
		}
		public function executeTechmapDelete(\Library\HTTPRequest $request) {
			$steps = $this->managers->getManagerOf('Production')->techmapDelete(
				$request->getData('id')
			);
			$this->app->httpResponse()->redirect('/production/step/' . $request->getData('order'));
		}
		public function executeSetGood(\Library\HTTPRequest $request) {
			$productionManager = $this->managers->getManagerOf('Production');

			$productionManager->setStatus(
				$request->getData('id'),
				1,
				$this->app->user()->getAttribute('supervisorID')
			);
			$production = $productionManager->get(
				$request->getData('id')
			);

			$this->managers->getManagerOf('ProductStockOperation')->add(
					$production['Date'],
					$production['RefProduct'],
					1,
					$production['Quantity']
				);

			$this->app->httpResponse()->redirect('/production/list');
		}
		public function executeSetBad(\Library\HTTPRequest $request) {
			$this->managers->getManagerOf('Production')->setStatus(
				$request->getData('id'),
				2,
				$this->app->user()->getAttribute('supervisorID')
			);
			$this->app->httpResponse()->redirect('/production/list');
		}
	}