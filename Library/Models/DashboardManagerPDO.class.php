<?php
	namespace Library\Models;

	class DashboardManagerPDO extends DashboardManager {
		public function data() {
			return [
				'ProductionCompleted' => $this->countCompletedProduction(),
				'ProductionAborted' => $this->countAbortedProduction(),
				'ProductionInProgress' => $this->countInProgressProduction()
			];
		}
		public function countCompletedProduction() {
			$query = $this->dao->prepare("SELECT COUNT(*) AS Nbre FROM tblproduction WHERE isProductionGood=1");
			$query->execute();
			return $query->fetch()['Nbre'];
		}
		public function countAbortedProduction() {
			$query = $this->dao->prepare("SELECT COUNT(*) AS Nbre FROM tblproduction WHERE isProductionGood=2");
			$query->execute();
			return $query->fetch()['Nbre'];
		}
		public function countInProgressProduction() {
			$query = $this->dao->prepare("SELECT COUNT(*) AS Nbre FROM tblproduction WHERE isProductionGood IS NULL");
			$query->execute();
			return $query->fetch()['Nbre'];
		}
	}