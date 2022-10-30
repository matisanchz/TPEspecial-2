<?php

class SubclassModel {

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
        $query = $this->db->prepare("SELECT * FROM subclass");
        $query->execute();

        // 3. obtengo los resultados
        $subclasses = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $subclasses;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM subclass WHERE id_subclass = ?");
        $query->execute([$id]);
        $subclass = $query->fetch(PDO::FETCH_OBJ);
        
        return $subclass;
    }

    /**
     * Inserta una tarea en la base de datos.
     */
    public function insert($name, $author, $id_class) {
        $query = $this->db->prepare("INSERT INTO subclass (name, author, id_class) VALUES (?, ?, ?)");
        $query->execute([$name, $author, $id_class]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina una tarea dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM subclass WHERE id_subclass = ?');
        $query->execute([$id]);
    }

    /**
     * Edita una clase en la base de datos.
     */
    public function edit($name, $author, $id_class, $id) {
        $query = $this->db->prepare("UPDATE subclass SET name=?,
                                                    author=?,
                                                    id_class=? 
                                            WHERE id_subclass=?");
        $query->execute([$name, $author, $id_class, $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }


    // public function finalize($id) {
    //     $query = $this->db->prepare('UPDATE class SET finalizada = 1 WHERE id = ?');
    //     $query->execute([$id]);
    //     // var_dump($query->errorInfo()); // y eliminar la redireccion
    // }
}
