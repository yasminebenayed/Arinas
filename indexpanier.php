<?php
session_start();?>

<?php
require_once 'app/Controllers/ControllerPanier.php';
$panierController = new ControllerPanier();
    $panierController-> findCartProducts();

?>