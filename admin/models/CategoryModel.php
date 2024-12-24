<?php
class CategoryModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCategories() {
        $req = "SELECT * FROM categorie";
        $results = $this->pdo->query($req);
        return $results->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoryByCode($categoryCode) {
        $req = "SELECT * FROM categorie WHERE code = :categoryCode";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':categoryCode', $categoryCode);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getSubCategoriesByCategoryCode($categoryCode) {
        $req = "SELECT * FROM sous_categorie WHERE code_categorie = :categoryCode";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':categoryCode', $categoryCode);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function deleteSubCategory($subCategoryCode) {
        $stmt = $this->pdo->prepare("DELETE FROM sous_categorie WHERE code = :code");
        $stmt->bindParam(':code', $subCategoryCode);
        $stmt->execute();
    }
    public function addCategory($categoryName) {
        $stmt = $this->pdo->prepare("INSERT INTO categorie (nomCategorie) VALUES (:categoryName)");
        $stmt->bindParam(':categoryName', $categoryName);
        $stmt->execute();
    }

    public function addSousCategorie($sousCategorieName, $categoryCode) {
        $stmt = $this->pdo->prepare("INSERT INTO sous_categorie (nom_sous_cat, code_categorie) VALUES (:sousCategorieName, :categoryCode)");
        $stmt->bindParam(':sousCategorieName', $sousCategorieName);
        $stmt->bindParam(':categoryCode', $categoryCode);
        $stmt->execute();
    }

    public function updateCategory($categoryName, $categoryCode) {
        $stmt = $this->pdo->prepare("UPDATE categorie SET nomCategorie = :categoryName WHERE code = :categoryCode");
        $stmt->bindParam(':categoryName', $categoryName);
        $stmt->bindParam(':categoryCode', $categoryCode);
        $stmt->execute();
    }

}
?>