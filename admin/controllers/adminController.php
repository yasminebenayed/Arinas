<?php
require_once "models/ProductModel.php";

class AdminController {
    private $productModel;

    public function __construct($pdo) {
        $this->productModel = new ProductModel($pdo);
    }

    public function handleRequest() {
        if (isset($_GET['delete'])) {
            $this->deleteProduct($_GET['delete']);
        } else {
            $this->showProducts();
        }
    }

    private function showProducts() {
        $products = $this->productModel->getAllProducts();
        include "views/productView.php";
    }

    private function deleteProduct($codeProduit) {
        $this->productModel->deleteProduct($codeProduit);
        header("Location: admin.php");
        exit();
    }
}
?>