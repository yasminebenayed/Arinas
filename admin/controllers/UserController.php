<?php
require_once "models/UserModel.php";

class UserController {
    private $userModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new UserModel($pdo);
    }

    public function handleRequest() {
        $this->showAllUsers();
    }

    private function showAllUsers() {
        $users = $this->userModel->getAllUsers();
        include "views/userView.php";
    }
}
?>