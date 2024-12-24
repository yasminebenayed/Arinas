<?php
require_once "models/OrderModel.php";

class OrderController {
    private $orderModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->orderModel = new OrderModel($pdo);
    }

    public function handleRequest() {
        if (isset($_GET['code'])) {
            $this->showOrderDetails($_GET['code']);
        } elseif (isset($_GET['codeUser'])) {
            $this->showOrdersByUser($_GET['codeUser']);
        } elseif (isset($_POST['updateStatus'])) {
            $this->updateOrderStatus();
        } else {
            $this->showAllOrders();
        }
    }

    private function showAllOrders() {
        $orders = $this->orderModel->getAllOrders();
        $pdo = $this->pdo; // Pass the $pdo variable to the view
        include "views/orderView.php";
    }

    private function showOrdersByUser($codeUser) {
        $orders = $this->orderModel->getOrdersByUser($codeUser);
        $userName = $this->orderModel->getUserName($codeUser);
        $pdo = $this->pdo; // Pass the $pdo variable to the view
        include "views/orderView.php";
    }

    private function showOrderDetails($codeCommande) {
        $commande = $this->orderModel->getOrderByCode($codeCommande);
        $detailsCommande = $this->orderModel->getOrderDetails($codeCommande);
        $client = $this->orderModel->getUserName($commande->code_client);
        $pdo = $this->pdo; // Pass the $pdo variable to the view
        include "views/orderDetailsView.php";
    }

    private function updateOrderStatus() {
        $orderId = $_POST['orderId'];
        $newStatus = $_POST['newStatus'];
        $this->orderModel->updateOrderStatus($orderId, $newStatus);
        header("Location: index.php?action=orders");
        exit();
    }
}
?>