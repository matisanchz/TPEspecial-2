<?php

class GenericModel{
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_molluscs;charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

}