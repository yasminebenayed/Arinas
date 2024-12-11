<?php

require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../models/ModelPanier.php';
require_once __DIR__ . '/../models/Database.php';

class ControllerPanier 
{
    private $model;

    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->model = new ModelPanier($db);
    }

    public function index()
    {
        $controller = "Panier";
        include("app/views/panier.php");
    }

    public function addToCart()
    {
        if (isset($_GET["addToCart"])) {
            
            $userCode = $_SESSION["user_id"];
            $productCode = $_GET["addToCart"];

            $isProductInCart = $this->model->isProductInCart($userCode, $productCode);

            if ($isProductInCart) {
                $this->model->updateQuantity($userCode, $productCode);
            } else {
                $qte= isset($_GET["qte"])?$_GET["qte"]:1;
                $this->model->addToCart($userCode, $productCode,$qte);
            }

            $response = ['success' => true, 'message' => 'Produit ajouté au panier avec succès.'];
           // echo json_encode($response);
           if ($_SERVER['REQUEST_URI'] == "/index.php?action=produit") {
            header("Location: index.php?action=produit");
        } else  {
            header("Location: index.php?action=panier");
        } // Terminer l'exécution du script après redirection
        
        
            exit();
        }
        
    }
    public function deleteProducts()
    {
        if (isset($_GET["deletecart"])) {
            // Récupérer le code du produit depuis l'URL
            $productCode = $_GET["deletecart"];
            $userCode = (int)$_SESSION["user_id"]; // Récupération de l'ID utilisateur
    
            try {
                // Vérifier si le produit existe dans le panier de l'utilisateur
                $product = $this->model->getProductFromCart($userCode, $productCode);
                echo "<script>alert('Voulez vous supprimerce produit du panier');</script>";                
                if ($product) {
                    // Si la quantité est plus grande que 1, on réduit la quantité
                    if ($product->qte > 1) {
                        $this->model->updateQuantitymoins($userCode, $productCode);
                      //  echo "success: quantity decreased";
                    } else {
                        // Sinon, on supprime le produit du panier
                        $this->model->deleteProduct($userCode, $productCode);
                       // echo "success: product removed";
                    }
                } else {
                    echo "<script>alert('produit en rupture de stock');</script>";                

                }
                header("Location: index.php?action=panier");

            } catch (PDOException $e) {
                // Gestion des erreurs de base de données
                //echo "error: " . $e->getMessage();
            }
        } else {
           
           // echo "error: No product ID provided";
        }


    }
    
    

    


           
    
   
    public function findCartProducts()
    {
        $userCode = $_SESSION["user_id"];
        $produits = $this->model->getCartProducts($userCode);
        header(Location:"app/views/Panier/panier.php");
        return $produits;
    }
    public function getMontantTotal()
    {
        $userCode = $_SESSION["user_id"];
        $produits = $this->model->getCartProducts($userCode);
        $total = 0;
        foreach ($produits as $produit) {
            $total += $produit->prix * $produit->qte;
        }
        return $total;
    }
    

}

?>