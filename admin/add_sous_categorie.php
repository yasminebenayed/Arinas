<?php
require_once("connexionDb.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sousCategorieName'], $_POST['categoryCode'])) {
    $sousCategorieName = $_POST['sousCategorieName'];
    $categoryCode = $_POST['categoryCode'];
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO sous_categorie (nom_sous_cat, code_categorie) VALUES (:sousCategorieName, :categoryCode)");
    $stmt->bindParam(':sousCategorieName', $sousCategorieName);
    $stmt->bindParam(':categoryCode', $categoryCode);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>
    <body>
        <h1><?php echo ""; ?></h1>
    </body>
</html>