<?php
	namespace Library\Models;

	class MaterialStockOperationManagerPDO extends MaterialStockOperationManager {
		public function operationTypes() {
            $query = $this->dao->prepare("SELECT * FROM tbloperationtype");
            $query->execute();
            return $query->fetchAll();
        }
		public function list() {
			$query = $this->dao->prepare("SELECT tblmaterialstockoperation.*, tbloperationtype.*, tblmaterial.Article, tblmaterial.Name FROM tblmaterialstockoperation INNER JOIN tbloperationtype ON (tblmaterialstockoperation.RefOperationType = tbloperationtype.RefOperationType) INNER JOIN tblmaterial ON (tblmaterialstockoperation.RefMaterial = tblmaterial.RefMaterial)");
			$query->execute();
			return $query->fetchAll();
		}
        public function add($date, $material, $operation_type, $quantity) {
            $query = $this->dao->prepare("INSERT INTO tblmaterialstockoperation (Date, RefMaterial, RefOperationType, Quantity) VALUES (:date, :material, :operation_type, :quantity)");
            $query->bindValue(':date', $date, \PDO::PARAM_STR);
            $query->bindValue(':material', $material, \PDO::PARAM_STR);
            $query->bindValue(':operation_type', $operation_type, \PDO::PARAM_STR);
            $query->bindValue(':quantity', $quantity, \PDO::PARAM_STR);
            $query->execute();
        }
        public function update($id, $date, $material, $operation_type, $quantity) {
            $query = $this->dao->prepare("UPDATE tblmaterialstockoperation SET Date=:date, RefMaterial=:material, RefOperationType=:operation_type, Quantity=:quantity WHERE RefOperation=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->bindValue(':date', $date, \PDO::PARAM_STR);
            $query->bindValue(':material', $material, \PDO::PARAM_STR);
            $query->bindValue(':operation_type', $operation_type, \PDO::PARAM_STR);
            $query->bindValue(':quantity', $quantity, \PDO::PARAM_INT);
            $query->execute();
        }
        public function delete($id) {
            $query = $this->dao->prepare("DELETE FROM tblmaterialstockoperation WHERE RefOperation=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
        }
        public function stock() {
            $materials = $this->materials();
            foreach ($materials as $key => $material) {
                $materials[$key]['Stock'] = $this->materialTotalIn($material['RefMaterial']) - $this->materialTotalOut($material['RefMaterial']);
            }
            return $materials;
        }
        protected function materials() {
            $query = $this->dao->prepare("SELECT * FROM tblmaterial");
            $query->execute();
            return $query->fetchAll();
        }
        public function materialTotalIn(int $material) {
            $query = $this->dao->prepare("SELECT SUM(Quantity) AS TotalQuantity FROM tblmaterialstockoperation WHERE RefOperationType=1 AND RefMaterial=:id");
            $query->bindValue(':id', $material, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['TotalQuantity'];
        }
        public function materialTotalOut(int $material) {
            $query = $this->dao->prepare("SELECT SUM(Quantity) AS TotalQuantity FROM tblmaterialstockoperation WHERE RefOperationType=2 AND RefMaterial=:id");
            $query->bindValue(':id', $material, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['TotalQuantity'];
        }
	}