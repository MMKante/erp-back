<?php
	namespace Library\Models;

	class ProductionManagerPDO extends ProductManager {
		public function list() {
			$query = $this->dao->prepare("SELECT tblproduction.*, tblproduct.Name AS ProductName, tblproduct.Article AS ProductArticle FROM tblproduction INNER JOIN tblproduct ON (tblproduction.RefProduct = tblproduct.RefProduct)");
			$query->execute();
			return $query->fetchAll();;
		}
		public function get($id) {
			$query = $this->dao->prepare("SELECT * FROM tblproduction WHERE RefOrder=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
			return $query->fetch();
		}
		public function add($number, $date, $product, $quantity, $arrival_date, $supervisor) {
			$query = $this->dao->prepare("INSERT INTO tblproduction (Number, Date, RefProduct, Quantity, ArrivalDate, RefProductionSupervisor) VALUES (:number, :date, :product, :quantity, :arrival_date, :supervisor)");
			$query->bindValue(':number', $number, \PDO::PARAM_INT);
			$query->bindValue(':date', $date, \PDO::PARAM_STR);
			$query->bindValue(':product', $product, \PDO::PARAM_INT);
			$query->bindValue(':quantity', $quantity, \PDO::PARAM_INT);
			$query->bindValue(':arrival_date', $arrival_date, \PDO::PARAM_STR);
			$query->bindValue(':supervisor', $supervisor, \PDO::PARAM_INT);
			$query->execute();
		}
		public function update($id, $number, $date, $product, $quantity, $arrival_date) {
			$query = $this->dao->prepare("UPDATE tblproduction SET Number=:number, Date=:date, RefProduct=:product, Quantity=:quantity, ArrivalDate=:arrival_date WHERE RefOrder=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':number', $number, \PDO::PARAM_INT);
			$query->bindValue(':date', $date, \PDO::PARAM_STR);
			$query->bindValue(':product', $product, \PDO::PARAM_INT);
			$query->bindValue(':quantity', $quantity, \PDO::PARAM_INT);
			$query->bindValue(':arrival_date', $arrival_date, \PDO::PARAM_STR);
			$query->execute();
		}
		public function delete($id) {
			$query = $this->dao->prepare("DELETE FROM tblproduction WHERE RefOrder=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
		}
		public function steps($order) {
			$query = $this->dao->prepare("SELECT * FROM tblrealizationstep WHERE RefOrder=:order");
			$query->bindValue(':order', $order, \PDO::PARAM_INT);
			$query->execute();
			return $query->fetchAll();
		}
		public function addStep($order, $step) {
			$query = $this->dao->prepare("INSERT INTO tblrealizationstep (RefOrder, Step) VALUES (:order, :step)");
			$query->bindValue(':order', $order, \PDO::PARAM_INT);
			$query->bindValue(':step', $step, \PDO::PARAM_STR);
			$query->execute();
		}
		public function deleteStep($id) {
			$query = $this->dao->prepare("DELETE FROM tblrealizationstep WHERE RefStep=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
		}
		public function updateStep($id, $step) {
			$query = $this->dao->prepare("UPDATE tblrealizationstep SET Step=:step WHERE RefStep=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':step', $step, \PDO::PARAM_STR);
			$query->execute();
		}
		public function completeStep($id) {
			$query = $this->dao->prepare("UPDATE tblrealizationstep SET isCompleted=1 WHERE RefStep=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
		}
		public function technologicalMapList($id) {
			$query = $this->dao->prepare("SELECT * FROM tbltechnologicalmap INNER JOIN tblmaterialstockoperation ON (tbltechnologicalmap.RefOperation = tblmaterialstockoperation.RefOperation) INNER JOIN tblmaterial ON (tblmaterialstockoperation.RefMaterial = tblmaterial.RefMaterial) WHERE tbltechnologicalmap.RefStep=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetchAll();

			foreach ($result as $key => $line) {
				$result[$key]['DateFormated'] = date('d.m.Y', strtotime($line['Date']));
				$result[$key]['MaterialName'] = $line['Article'].' | '.$line['Name'];
			}

			return $result;
		}
		public function techmapAdd($step, $date, $material, $quantity) {
			$operation = $this->techmapAddOperation($date, $material, $quantity);

			$query = $this->dao->prepare("INSERT INTO tbltechnologicalmap (RefStep, RefOperation) VALUES(:step, :operation)");
			$query->bindValue(':step', $step, \PDO::PARAM_INT);
			$query->bindValue(':operation', $operation, \PDO::PARAM_STR);
			$query->execute();
		}
		protected function techmapAddOperation($date, $material, $quantity) {
			$query = $this->dao->prepare("INSERT INTO tblmaterialstockoperation (Date, RefMaterial, RefOperationType, Quantity) VALUES (:date, :material, 2, :quantity)");
            $query->bindValue(':date', $date, \PDO::PARAM_STR);
            $query->bindValue(':material', $material, \PDO::PARAM_STR);
            $query->bindValue(':quantity', $quantity, \PDO::PARAM_STR);
            $query->execute();
            return $this->dao->lastInsertId();
		}
		public function techmapDelete($id) {
			$techmap = $this->techmapGet($id)['RefOperation'];

			$this->techmapDeleteOperation($techmap);

			$query = $this->dao->prepare("DELETE FROM tbltechnologicalmap WHERE RefTechnologicalMap=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
		}
		public function techmapGet($id) {
			$query = $this->dao->prepare("SELECT * FROM tbltechnologicalmap WHERE RefTechnologicalMap=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
			return $query->fetch();
		}
		public function techmapDeleteOperation($id) {
			$query = $this->dao->prepare("DELETE FROM tblmaterialstockoperation WHERE RefOperation=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
		}
		public function setStatus($id, $status, $supervisor) {
			$query = $this->dao->prepare("UPDATE tblproduction SET isProductionGood=:status, RefQualitySupervisor=:supervisor WHERE RefOrder=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':status', $status, \PDO::PARAM_INT);
			$query->bindValue(':supervisor', $supervisor, \PDO::PARAM_INT);
			$query->execute();
		}
	}