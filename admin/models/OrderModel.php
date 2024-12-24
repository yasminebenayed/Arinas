<?php
class OrderModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllOrders() {
        $req = "SELECT * FROM commande";
        $stmt = $this->pdo->prepare($req);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrdersByUser($codeUser) {
        $req = "SELECT * FROM commande WHERE code_client = :codeUser";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':codeUser', $codeUser);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserName($codeUser) {
        $req = "SELECT nom FROM users WHERE code = :code_client";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':code_client', $codeUser);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getOrderByCode($codeCommande) {
        $req = "SELECT * FROM commande WHERE code = :code_commande";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':code_commande', $codeCommande);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getOrderDetails($codeCommande) {
        $req = "SELECT * FROM details_commande WHERE code_commande = :code_commande";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':code_commande', $codeCommande);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateOrderStatus($orderId, $newStatus) {
        $req = "UPDATE commande SET status = :newStatus WHERE code = :orderId";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':newStatus', $newStatus);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
    }
}
?>