<?php
require_once("config/connexionDb.php");

if (isset($_GET['category_code'])) {
    $categoryCode = $_GET['category_code'];
    $stmt = $pdo->prepare("SELECT * FROM sous_categorie WHERE code_categorie = :categoryCode");
    $stmt->bindParam(':categoryCode', $categoryCode);
    $stmt->execute();
    $subCategories = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($subCategories);
}
?>