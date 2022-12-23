<?php
    namespace Library\Models;

    class DepartmentManagerPDO extends ProductManager {
        public function list() {
            $query = $this->dao->prepare("SELECT * FROM tbldepartment WHERE RefDepartment != 0");
            $query->execute();
            return $query->fetchAll();
        }
    }