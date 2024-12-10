<?php
session_start();?>
<?php
require_once 'app/Controllers/ControllerProduit.php';
$productControler = new ControllerProduit();
    $productControler-> index();
?>