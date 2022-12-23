<?php
    namespace Library\Models;

    class MaterialManagerPDO extends MaterialManager {
        public function list() {
            $query = $this->dao->prepare("SELECT * FROM tblmaterial");
            $query->execute();
            return $query->fetchAll();
        }
        public function add($article, $name, $unity, $cost) {
            $query = $this->dao->prepare("INSERT INTO tblmaterial (Article, Name, Unity, Cost) VALUES (:article, :name, :unity, :cost)");
            $query->bindValue(':article', $article, \PDO::PARAM_STR);
            $query->bindValue(':name', $name, \PDO::PARAM_STR);
            $query->bindValue(':unity', $unity, \PDO::PARAM_STR);
            $query->bindValue(':cost', $cost, \PDO::PARAM_INT);
            $query->execute();
        }
        public function update($id, $article, $name, $unity, $cost) {
            $query = $this->dao->prepare("UPDATE tblmaterial SET Article=:article, Name=:name, Unity=:unity, Cost=:cost WHERE RefMaterial=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->bindValue(':article', $article, \PDO::PARAM_STR);
            $query->bindValue(':name', $name, \PDO::PARAM_STR);
            $query->bindValue(':unity', $unity, \PDO::PARAM_STR);
            $query->bindValue(':cost', $cost, \PDO::PARAM_INT);
            $query->execute();
        }
        public function delete($id) {
            $query = $this->dao->prepare("DELETE FROM tblmaterial WHERE RefMaterial=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
        }
    }