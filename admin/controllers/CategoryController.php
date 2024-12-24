<?php
require_once "models/CategoryModel.php";

class CategoryController {
    private $categoryModel;

    public function __construct($pdo) {
        $this->categoryModel = new CategoryModel($pdo);
    }
    public function handleRequest() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'categoryDetails':
                    if (isset($_GET['category_code'])) {
                        $this->showCategoryDetails($_GET['category_code']);
                    } else {
                        echo "Category code not specified.";
                        exit();
                    }
                    break;
                case 'addCategory':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $this->addCategory();
                    } else {
                        $this->showAddCategoryForm();
                    }
                    break;
                case 'addSousCategorie':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $this->addSousCategorie();
                    } else {
                        $this->showAddSousCategorieForm();
                    }
                    break;
                case 'deleteSubCategory':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sub_category_code'])) {
                        $this->deleteSubCategory();
                    }
                    break;
                default:
                    $this->showAllCategories();
                    break;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sub_category_code'])) {
            $this->deleteSubCategory();
        } else {
            $this->showAllCategories();
        }
    }
    
    private function deleteSubCategory() {
        $subCategoryCode = $_POST['sub_category_code'];
    
        // Debugging statements
        error_log("Deleting subcategory with code: " . $subCategoryCode);
    
        $this->categoryModel->deleteSubCategory($subCategoryCode);
        header("Location: index.php?action=categories");
        exit();
    }
    
    
    private function showAllCategories() {
        $categories = $this->categoryModel->getAllCategories();
        include "views/categoryView.php";
    }

    private function showCategoryDetails($categoryCode) {
        $category = $this->categoryModel->getCategoryByCode($categoryCode);
        $subCategories = $this->categoryModel->getSubCategoriesByCategoryCode($categoryCode);
        include "views/categoryDetailsView.php";
    }

    private function showAddCategoryForm() {
        include "views/addCategoryView.php";
    }

    private function addCategory() {
        $categoryName = $_POST['categorie'];
        $this->categoryModel->addCategory($categoryName);
        header("Location: index.php?action=categories");
        exit();
    }

    private function showAddSousCategorieForm() {
        $categories = $this->categoryModel->getAllCategories();
        include "views/addSousCategorieView.php";
    }

    private function addSousCategorie() {
        $sousCategorieName = $_POST['sousCategorieName'];
        $categoryCode = $_POST['categoryCode'];
        $this->categoryModel->addSousCategorie($sousCategorieName, $categoryCode);
        header("Location: index.php?action=categories&category_code=" . urlencode($categoryCode));
        exit();
    }

    
    
}
?>