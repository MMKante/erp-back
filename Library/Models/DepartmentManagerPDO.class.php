<?php
    namespace Library\Models;

    class DepartmentManagerPDO extends ProductManager {
        public function list() {
            $query = $this->dao->prepare("SELECT * FROM tbldepartment");
            $query->execute();
            return $query->fetchAll();
        }
    }