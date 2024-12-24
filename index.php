<?php
session_start();?>

<?php
require_once 'app/Controllers/ControllerHome.php';
$HomeControler = new ControllerHome();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'login':
            $HomeControler-> loginProcess();
                    break;
        case 'createuser':
            $HomeControler-> createProcess();
            break;
        case'logout':
            $HomeControler-> logout();
            break;
        case'contact':
            $HomeControler-> contact();
            break;    
       
        }
}
?>
<?php
require_once 'app/Controllers/ControllerPanier.php';
$panierController = new ControllerPanier();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'ajoutpanier':
            $panierController-> addToCart();
            break;
        case 'ajoutpanier1':
            $panierController-> addToCart1();
            break;    
        case 'deletepanier':
            $panierController-> deleteProducts();
            break;
         case'panier':
            $panierController-> findCartProducts();
            break;   
       
        }
    }


?>
<?php
require_once 'app/Controllers/ControllerProduit.php';

$productController = new ControllerProduit();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'produit':
            $productController->index();
            break;

        case 'detailproduit':
            $productController->voirProduit();
            break;

        case 'search':
            $productController->rechercher();
            break;

        case 'searchcat':
            $productController->filtrerCategorie();
            break;

    }
}
?>
<?php
require_once 'app/Controllers/ControllerCommande.php';
$ControllerCommande  = new ControllerCommande ();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'voirmoncommande':
            $ControllerCommande -> index();
            break;
        case 'createcommande':
            $ControllerCommande -> createcommande();
            break;
         case'panier':
            $panierController-> findCartProducts();
            break;   
       
        }
    }


?>
