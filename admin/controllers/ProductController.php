<?php
require_once "models/ProductModel.php";

class ProductController {
    private $productModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->productModel = new ProductModel($pdo);
    }

    public function handleRequest() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'addProduct':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $this->addProduct();
                    } else {
                        $this->showAddProductForm();
                    }
                    break;
                case 'updateProduct':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $this->updateProduct();
                    } else {
                        $this->showUpdateForm($_GET['update']);
                    }
                    break;
                case 'deleteProduct':
                    if (isset($_GET['delete'])) {
                        $this->deleteProduct($_GET['delete']);
                    }
                    break;
                default:
                    $this->showAllProducts();
                    break;
            }
        } else {
            $this->showAllProducts();
        }
    }

    private function showAddProductForm() {
        $categories = $this->productModel->getAllCategories();
        $marques = $this->productModel->getAllMarques();
        $defaultSelectedCode = 1;
        $sousCategories = $this->productModel->getSousCategories($defaultSelectedCode);
        include "views/addProductView.php";
    }

    private function addProduct() {
        $nomProduit = $_POST['nomProduit'];
        $description = $_POST['description'];
        $designation = $_POST['designation'];
        $codeCategorie = $_POST['categorie'];
        $codeMarque = $_POST['marque'];
        $codeSousCat = $_POST['sous_categorie'];
        $prix = $_POST['prix'];
        $promo = $_POST['promo'];
        $qte = $_POST['quantite'];

        // Handle image upload
        $img = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $imgName = $_FILES['image']['name'];
            $imgTmpName = $_FILES['image']['tmp_name'];
            $img = "" . $imgName;
            move_uploaded_file($imgTmpName, $img);
        }

        $this->productModel->addProduct($nomProduit, $description, $designation, $codeCategorie, $codeMarque, $codeSousCat, $prix, $promo, $qte, $img);
        header("Location: index.php?action=products");
        exit();
    }

    private function showUpdateForm($codeProduit) {
        $categories = $this->productModel->getAllCategories();
        $marques = $this->productModel->getAllMarques();
        $produit = $this->productModel->getProductByCode($codeProduit);
        $sousCategories = $this->productModel->getSousCategories($produit->code_categorie);
        include "views/updateProductView.php";
    }

    private function updateProduct() {
        $codeProduit = $_POST['codeProduit'];
        $formData = [
            'nomProduit' => $_POST['nomProduit'],
            'categorie' => $_POST['categorie'],
            'sous_categorie' => $_POST['sous_categorie'],
            'quantite' => $_POST['quantite'],
            'prix' => $_POST['prix'],
            'promo' => $_POST['promo'],
            'description' => $_POST['description'],
            'designation' => $_POST['designation'],
            'marque' => $_POST['marque'],
            'image' => $_POST['current_image'],
        ];

        if ($_FILES['image']['error'] === 0) {
            $imagePath = "" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            $formData['image'] = $imagePath;
        }

        $rowCount = $this->productModel->updateProduct($formData, $codeProduit);

        if ($rowCount > 0) {
            header("Location: index.php?action=products");
            exit();
        } else {
            echo "Erreur lors de la mise à jour du produit.";
        }
    }

    private function deleteProduct($codeProduit) {
        $rowCount = $this->productModel->deleteProduct($codeProduit);

        if ($rowCount > 0) {
            header("Location: index.php?action=products");
            exit();
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    }
    private function showAllProducts() {
        $products = $this->productModel->getAllProducts();
        include "views/productView.php";
    }
}
?>