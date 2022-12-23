<?php
	namespace Library\Models;

	class ProductStockOperationManagerPDO extends ProductStockOperationManager {
		public function operationTypes() {
            $query = $this->dao->prepare("SELECT * FROM tbloperationtype");
            $query->execute();
            return $query->fetchAll();
        }
		public function list() {
			$query = $this->dao->prepare("SELECT tblproductstockoperation.*, tbloperationtype.*, tblproduct.Article, tblproduct.Name FROM tblproductstockoperation INNER JOIN tbloperationtype ON (tblproductstockoperation.RefOperationType = tbloperationtype.RefOperationType) INNER JOIN tblproduct ON (tblproductstockoperation.RefProduct = tblproduct.RefProduct)");
			$query->execute();
			return $query->fetchAll();
		}
        public function add($date, $material, $operation_type, $quantity) {
            $query = $this->dao->prepare("INSERT INTO tblproductstockoperation (Date, RefProduct, RefOperationType, Quantity) VALUES (:date, :material, :operation_type, :quantity)");
            $query->bindValue(':date', $date, \PDO::PARAM_STR);
            $query->bindValue(':material', $material, \PDO::PARAM_STR);
            $query->bindValue(':operation_type', $operation_type, \PDO::PARAM_STR);
            $query->bindValue(':quantity', $quantity, \PDO::PARAM_STR);
            $query->execute();
        }
        public function update($id, $date, $material, $operation_type, $quantity) {
            $query = $this->dao->prepare("UPDATE tblproductstockoperation SET Date=:date, RefProduct=:material, RefOperationType=:operation_type, Quantity=:quantity WHERE RefOperation=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->bindValue(':date', $date, \PDO::PARAM_STR);
            $query->bindValue(':material', $material, \PDO::PARAM_STR);
            $query->bindValue(':operation_type', $operation_type, \PDO::PARAM_STR);
            $query->bindValue(':quantity', $quantity, \PDO::PARAM_INT);
            $query->execute();
        }
        public function delete($id) {
            $query = $this->dao->prepare("DELETE FROM tblproductstockoperation WHERE RefOperation=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
        }
        public function stock() {
            $products = $this->products();
            foreach ($products as $key => $product) {
                $products[$key]['Stock'] = $this->productTotalIn($product['RefProduct']) - $this->productTotalOut($product['RefProduct']);
            }
            return $products;
        }
        protected function products() {
            $query = $this->dao->prepare("SELECT * FROM tblproduct");
            $query->execute();
            return $query->fetchAll();
        }
        public function productTotalIn(int $product) {
            $query = $this->dao->prepare("SELECT SUM(Quantity) AS TotalQuantity FROM tblproductstockoperation WHERE RefOperationType=1 AND RefProduct=:id");
            $query->bindValue(':id', $product, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['TotalQuantity'];
        }
        public function productTotalOut(int $product) {
            $query = $this->dao->prepare("SELECT SUM(Quantity) AS TotalQuantity FROM tblproductstockoperation WHERE RefOperationType=2 AND RefProduct=:id");
            $query->bindValue(':id', $product, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['TotalQuantity'];
        }
	}