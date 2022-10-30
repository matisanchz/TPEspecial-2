<?php

class ClassModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_molluscs;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de tareas completa.
     */
    public function getAll() {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM Class");
        $query->execute();

        // 3. obtengo los resultados
        $classes = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $classes;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM Class WHERE id_class = ?");
        $query->execute([$id]);
        $class = $query->fetch(PDO::FETCH_OBJ);
        
        return $class;
    }

    /**
     * Inserta una tarea en la base de datos.
     */
    public function insert($name, $author, $features) {
        $query = $this->db->prepare("INSERT INTO class (name, author, features) VALUES (?, ?, ?)");
        $query->execute([$name, $author, $features]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina una tarea dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM class WHERE id_class = ?');
        $query->execute([$id]);
    }

    /**
     * Edita una clase en la base de datos.
     */
    public function edit($name, $author, $features, $id) {
        $query = $this->db->prepare("UPDATE Class SET name=?,
                                                    author=?,
                                                    features=? 
                                            WHERE id_class=?");
        $query->execute([$name, $author, $features, $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }


    // public function finalize($id) {
    //     $query = $this->db->prepare('UPDATE class SET finalizada = 1 WHERE id = ?');
    //     $query->execute([$id]);
    //     // var_dump($query->errorInfo()); // y eliminar la redireccion
    // }
}
