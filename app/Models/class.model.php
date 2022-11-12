<?php

require_once './app/Models/generic.model.php';

class ClassModel extends GenericModel{

    public function __construct() {
        parent::__construct();
    }

    public function getAll($column, $value, $orderBy, $cond, $limit, $offset) {
        $query = $this->db->prepare("SELECT * FROM class WHERE $column = ? ORDER BY $orderBy $cond LIMIT ? OFFSET ?");
        $query->execute([$value, $limit, $offset]);

        $classes = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $classes;
    }

    public function getQuantRegisters() {
        $query = $this->db->prepare("SELECT COUNT(*) FROM class");
        $query->execute();

        return $query->fetchColumn();
    
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM Class WHERE id_class = ?");
        $query->execute([$id]);
        $class = $query->fetch(PDO::FETCH_OBJ);
        
        return $class;
    }

    public function insert($name, $author, $features) {
        $query = $this->db->prepare("INSERT INTO class (name, author, features) VALUES (?, ?, ?)");
        $query->execute([$name, $author, $features]);

        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM class WHERE id_class = ?');
        $query->execute([$id]);
    }

    public function edit($name, $author, $features, $id) {
        $query = $this->db->prepare("UPDATE Class SET name=?,
                                                    author=?,
                                                    features=? 
                                            WHERE id_class=?");
        $query->execute([$name, $author, $features, $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

}
