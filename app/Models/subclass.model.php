<?php

class SubclassModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_molluscs;charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function getAll($column, $value, $orderBy, $cond, $limit, $offset) {
        $query = $this->db->prepare("SELECT * FROM subclass WHERE $column = ? ORDER BY $orderBy $cond LIMIT ? OFFSET ?");
        $query->execute([$value, $limit, $offset]);

        $subclasses = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $subclasses;
    }

    public function getQuantRegisters() {
        $query = $this->db->prepare("SELECT COUNT(*) FROM subclass");
        $query->execute();

        return $query->fetchColumn();
    
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM subclass WHERE id_subclass = ?");
        $query->execute([$id]);
        $subclass = $query->fetch(PDO::FETCH_OBJ);
        
        return $subclass;
    }

    public function insert($name, $author, $id_class) {
        $query = $this->db->prepare("INSERT INTO subclass (name, author, id_class) VALUES (?, ?, ?)");
        $query->execute([$name, $author, $id_class]);

        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM subclass WHERE id_subclass = ?');
        $query->execute([$id]);
    }

    public function edit($name, $author, $id_class, $id) {
        $query = $this->db->prepare("UPDATE subclass SET name=?,
                                                    author=?,
                                                    id_class=? 
                                            WHERE id_subclass=?");
        $query->execute([$name, $author, $id_class, $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
