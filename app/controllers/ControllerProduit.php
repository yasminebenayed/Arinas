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
       if (isset($_GET['nomProduit']) && !empty($_GET['nomProduit'])) {
           // Connexion à la base de données
           $db = Database::getInstance()->getConnection();
           $model = new ModelProduit($db);
   
           // Récupération du terme de recherche
           $searchTerm = htmlspecialchars($_GET['nomProduit']);
   
           // Recherche dans le modèle
           $produits = $model->rechercher($searchTerm);
   
           // Inclusion de la vue
           include("app/views/Produit/listproduit.php");
           exit();
       } else {
           echo "Veuillez entrer un terme de recherche.";
       }
   }
   
    public function filtrercategorie()
    {
        // Vérification et récupération du nom de la catégorie
        $category_name = isset($_GET['category']) ? trim($_GET['category']) : null;
    
        if (!$category_name) {
            die("Erreur : Nom de catégorie non fourni.");
        }
    
        // Recherche de l'ID correspondant au nom de la catégorie
        $category_id = $this->model->getCategoryIdByName($category_name);
    
        if (!$category_id) {
            die("Erreur : Catégorie non trouvée pour le nom fourni.");
        }
    
        // Récupération des informations de la catégorie
        $category_info = $this->model->getCategoryInfo($category_id);
    
        if (!$category_info) {
            die("Erreur : Informations sur la catégorie introuvables.");
        }
    
        try {
            if (isset($_GET['sous_categorie']) && !empty($_GET['sous_categorie'])) {
                // Vérification et récupération du nom de la sous-catégorie
                $sous_categorie_name = trim($_GET['sous_categorie']);
                $sous_categorie_id = $this->model->getSousCategorieIdByName($sous_categorie_name, $category_id);
    
                if (!$sous_categorie_id) {
                    die("Erreur : Sous-catégorie non trouvée pour le nom fourni.");
                }
    
                // Récupération des produits filtrés
                $produits = $this->model->getFilteredProducts($category_id, $sous_categorie_id);
            } else {
                // Récupération des produits de la catégorie
                $produits = $this->model->getCategoryProducts($category_id);
            }
    
            // Inclusion de la vue pour afficher les produits
            include("app/views/Produit/listproduit.php");
        } catch (Exception $e) {
            die("Erreur lors de la récupération des produits : " . $e->getMessage());
        }
    
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