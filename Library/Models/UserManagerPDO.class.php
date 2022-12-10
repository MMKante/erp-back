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
        public function departments() {
            $query = $this->dao->prepare("SELECT * FROM tbldepartment");
            $query->execute();
            return $query->fetchAll();
        }
    }