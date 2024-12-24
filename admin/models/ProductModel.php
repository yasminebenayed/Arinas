<?php
class ProductModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProducts() {
        $req = "SELECT produit.*, categorie.nomCategorie AS categorie_nom FROM produit
                JOIN categorie ON produit.code_categorie = categorie.code";
        $results = $this->pdo->query($req);
        return $results->fetchAll(PDO::FETCH_OBJ);
    }



    public function getAllCategories() {
        $req = "SELECT * FROM categorie";
        $stmt = $this->pdo->query($req);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getAllMarques() {
        $req = "SELECT * FROM marque";
        $stmt = $this->pdo->query($req);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getSousCategories($codeCategorie) {
        $req = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
        $stmt = $this->pdo->prepare($req);
        $stmt->execute(['code' => $codeCategorie]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getProductByCode($codeProduit) {
        $stmt = $this->pdo->prepare("SELECT * FROM produit WHERE code = :code");
        $stmt->bindParam(':code', $codeProduit);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function updateProduct($formData, $codeProduit) {
        $stmtUpdate = $this->pdo->prepare("
            UPDATE produit SET 
                nomProduit = :nomProduit,
                description = :description,
                designation = :designation,
                code_categorie = :categorie,
                code_marque = :marque,
                code_sous_cat = :sous_categorie,
                prix = :prix,
                qte = :quantite,
                img = :image,
                promotion = :promo
            WHERE code = :codeProduit
        ");
        $stmtUpdate->execute(array_merge($formData, ['codeProduit' => $codeProduit]));
        return $stmtUpdate->rowCount();
    }
    public function addProduct($nomProduit, $description, $designation, $codeCategorie, $codeMarque, $codeSousCat, $prix, $promo, $qte, $img) {
        $sql = "INSERT INTO produit (nomProduit, description, designation, code_categorie, code_marque, code_sous_cat, prix, qte, img, promotion) 
                VALUES (:nomProduit, :description, :designation, :codeCategorie, :codeMarque, :codeSousCat, :prix, :qte, :img, :promo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nomProduit', $nomProduit);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':codeCategorie', $codeCategorie);
        $stmt->bindParam(':codeMarque', $codeMarque);
        $stmt->bindParam(':codeSousCat', $codeSousCat);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':promo', $promo);
        $stmt->bindParam(':qte', $qte);
        $stmt->bindParam(':img', $img);
        $stmt->execute();
    }
    public function deleteProduct($codeProduit) {
        $sql = "DELETE FROM produit WHERE code = :codeProduit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':codeProduit', $codeProduit);
        return $stmt->execute();
    }
    }
?>