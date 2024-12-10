<?php
session_start();?>
<?php
require_once 'app/Controllers/ControllerPanier.php';
$PanierControler = new ControllerPanier();
    $PanierControler-> addToCart();
?>