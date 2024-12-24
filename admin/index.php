<?php
session_start();

require_once "config/connexionDb.php";
require_once "controllers/AdminController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/OrderController.php";
require_once "controllers/UserController.php";
require_once "controllers/ProductController.php";

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'categories':
        $controller = new CategoryController($pdo);
        break;
    case 'categoryDetails':
        $controller = new CategoryController($pdo);
        break;
    case 'addCategory':
        $controller = new CategoryController($pdo);
        break;
    case 'addSousCategorie':
        $controller = new CategoryController($pdo);
        break;
    case 'deleteSubCategory':
        $controller = new CategoryController($pdo);
        break;
    case 'addSousCategorie':
        $controller = new CategoryController($pdo);
        break;
    case 'orders':
        $controller = new OrderController($pdo);
        break;
    case 'orderDetails':
        $controller = new OrderController($pdo);
        break;
    case 'users':
        $controller = new UserController($pdo);
        break;
    case 'updateProduct':
        $controller = new ProductController($pdo);
        break;
    case 'addProduct':
        $controller = new ProductController($pdo);
        break;
    case 'deleteProduct':
        $controller = new ProductController($pdo);
        break;
    case 'home':
    default:
        $controller = new AdminController($pdo);
        break;
}

$controller->handleRequest();
?>