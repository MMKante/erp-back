<?php
	namespace Applications\Backend\Modules\Product;

	class ProductController extends \Library\BackController {
		public function executeList(\Library\HTTPRequest $request) {
			$this->page->addVar('products', $this->managers->getManagerOf('Product')->list());
		}
	}