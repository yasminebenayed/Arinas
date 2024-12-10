<?php
require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../models/ModelProduit.php';
require_once __DIR__ . '/../models/Database.php';
class ControllerProduit 
{
    private $model;
    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->model = new ModelProduit($db);
    }
    public function index()
    {
        $produits = $this->model->findAll();
        $controller = "Produit";
        require_once ('app/views/Produit/listproduit.php');
   }
    public static function rechercher()
    {
        if (isset($_POST['query'])) {
            $db = Database::getInstance()->getConnection();
            $model = new ModelProduit($db);
            $searchTerm = $_POST['query'];
            $produits = $model->rechercher($searchTerm);

            include("app/views/Produit/produit.php");
            exit();
        }
    }
    public function filtrercategorie()
    {
        $category_id = $_GET['category'];
        $category_info = $this->model->getCategoryInfo($category_id);

        if (isset($_GET['sous_categorie']) && !empty($_GET['sous_categorie'])) {
            $sous_categorie_id = $_GET['sous_categorie'];
            $produits = $this->model->getFilteredProducts($category_id, $sous_categorie_id);
        } else {
            $produits = $this->model->getCategoryProducts($category_id);
        }
        include("app/views/Produit/produit.php");
        exit();
    }
    public function filtrersouscategorie()
    {
        $category_id = $_GET['category'];
        $category_info = $this->model->getCategoryInfo($category_id);
        $sous_categorie_id = $_GET['sous_categorie'];
        $produits = $this->model->getFilteredProducts($category_id, $sous_categorie_id);
        include("app/views/Produit/produit.php");
        exit();
    }

    public function promoProducts()
    {
        $produits = $this->model->getPromoProducts();
        include("app/views/Produit/produit.php");
        exit();
    }
    public function voirProduit()
    {
        if (isset($_GET['produit'])) {
            $productCode = $_GET['produit'];
            $productDetails = $this->model->getProduitByCode($productCode);
            if($productDetails->code_categorie==1){
                $cat="Cheveux";
            }elseif($productDetails->code_categorie==2){
                $cat="Visage";
            }elseif($productDetails->code_categorie==3){
                $cat="Corps";
            }

            if ($productDetails) {
                include("app/views/Produit/ProduitDetails.php");
                exit();
            }
        }
    }


}