<?php
	namespace Library\Models;

	class UserManagerPDO extends UserManager {
		public function login($username, $password) {
			$requete = $this->dao->prepare("SELECT * FROM tbluser INNER JOIN tblsupervisor ON (tbluser.RefSupervisor = tblsupervisor.RefSupervisor) WHERE tbluser.Username=:username AND tbluser.Password=:password AND tbluser.isActive=1");
			$requete->bindValue(':username', $username, \PDO::PARAM_STR);
			$requete->bindValue(':password', hash('sha512', $password), \PDO::PARAM_STR);
			$requete->execute();
			return $requete->fetch();
		}
		public function setUsername($id, $username) {
			$query = $this->dao->prepare("UPDATE tbluser SET Username=:username WHERE RefUser=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':username', $username, \PDO::PARAM_STR);
			$query->execute();
		}
		public function setPassword($id, $password) {
			$query = $this->dao->prepare("UPDATE tbluser SET Password=:password WHERE RefUser=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':password', hash('sha512', $password), \PDO::PARAM_STR);
			$query->execute();
		}
		public function addSupervisor($firstname, $lastname, $email, $phone, $department) {
			$query = $this->dao->prepare("INSERT INTO tblsupervisor (Firstname, Lastname, Email, Phone, RefDepartment) VALUES (:firstname, :lastname, :email, :phone, :department)");
			$query->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
			$query->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
			$query->bindValue(':email', $email, \PDO::PARAM_STR);
			$query->bindValue(':phone', $phone, \PDO::PARAM_STR);
			$query->bindValue(':department', $department, \PDO::PARAM_INT);
			$query->execute();
		}
		public function updateSupervisor($id, $firstname, $lastname, $email, $phone, $department) {
			$query = $this->dao->prepare("UPDATE tblsupervisor SET Firstname=:firstname, Lastname=:lastname, Email=:email, Phone=:phone, RefDepartment=:department WHERE RefSupervisor=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
			$query->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
			$query->bindValue(':email', $email, \PDO::PARAM_STR);
			$query->bindValue(':phone', $phone, \PDO::PARAM_STR);
			$query->bindValue(':department', $department, \PDO::PARAM_INT);
			$query->execute();
		}
		public function supervisors() {
			$query = $this->dao->prepare("SELECT tblsupervisor.*, tbldepartment.Department, tbluser.isActive FROM tblsupervisor INNER JOIN tbldepartment ON (tblsupervisor.RefDepartment = tbldepartment.RefDepartment) LEFT JOIN tbluser ON (tblsupervisor.RefSupervisor = tbluser.RefSupervisor) WHERE tblsupervisor.RefDepartment != 0");
			$query->execute();
			return $query->fetchAll();
		}
		public function supervisor($id) {
            $query = $this->dao->prepare("SELECT tblsupervisor.*, tbldepartment.Department, tbluser.isActive FROM tblsupervisor INNER JOIN tbldepartment ON (tblsupervisor.RefDepartment = tbldepartment.RefDepartment) LEFT JOIN tbluser ON (tblsupervisor.RefSupervisor = tbluser.RefSupervisor) WHERE tblsupervisor.RefSupervisor=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        }
		public function deleteSupervisor($id) {
			$query = $this->dao->prepare("DELETE FROM tblsupervisor WHERE RefSupervisor=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();
		}
		public function setPassSupervisor($id, $username, $password) {
			$query = $this->dao->prepare("DELETE FROM tbluser WHERE RefSupervisor=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->execute();

			$query2 = $this->dao->prepare("INSERT INTO tbluser (RefSupervisor, Username, Password) VALUES (:id, :username, :password)");
			$query2->bindValue(':id', $id, \PDO::PARAM_INT);
			$query2->bindValue(':username', $username, \PDO::PARAM_STR);
			$query2->bindValue(':password', hash('sha512', $password), \PDO::PARAM_STR);
			$query2->execute();
		}

		public function setStatus($id, $status) {
			$query = $this->dao->prepare("UPDATE tbluser SET isActive=:status WHERE RefSupervisor=:id");
			$query->bindValue(':id', $id, \PDO::PARAM_INT);
			$query->bindValue(':status', $status, \PDO::PARAM_INT);
			$query->execute();
		}
	}