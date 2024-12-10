<?php
session_start();?>
<?php
require_once 'app/Controllers/ControllerCommande.php';
$ControllerCommande  = new ControllerCommande ();
    $ControllerCommande -> index();

?>