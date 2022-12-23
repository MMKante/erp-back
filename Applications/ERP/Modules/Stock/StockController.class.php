<?php
	namespace Applications\ERP\Modules\Stock;

	class StockController extends \Library\BackController {
		public function executeProduct(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Product stock');

			$products = $this->managers->getManagerOf('ProductStockOperation')->stock();

			$this->page->addVar('products', $products);
		}
		public function executeMaterial(\Library\HTTPRequest $request) {
			$this->page->addVar('title', 'Material stock');

			$materials = $this->managers->getManagerOf('MaterialStockOperation')->stock();

			$this->page->addVar('materials', $materials);
		}
	}