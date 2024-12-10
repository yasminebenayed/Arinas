
<?php
session_start();?>
<?php
require_once 'app/Controllers/ControllerHome.php';
$HomeControler = new ControllerHome();
    $HomeControler-> createProcess();
?>