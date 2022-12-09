<?php
    namespace Library\Models;

    class ProductManagerPDO extends ProductManager {
        public function list() {
            $requete = $this->dao->prepare("SELECT * FROM tblproduct INNER JOIN tblcategory ON (tblproduct.RefCategory = tblcategory.RefCategory)");
            $requete->execute();
            return $requete->fetchAll();
        }
    }