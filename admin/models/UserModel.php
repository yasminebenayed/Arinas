<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllUsers() {
        $req = "SELECT * FROM users";
        $results = $this->pdo->query($req);
        return $results->fetchAll(PDO::FETCH_OBJ);
    }
}
?>