<?php

class UserModel extends GenericModel{

    public function __construct() {
        parent::__construct();
    }

    public function getUser($email) {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
