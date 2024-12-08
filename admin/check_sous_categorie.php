<?php
require_once("connexionDb.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sousCategorieName'])) {
    $sousCategorieName = $_POST['sousCategorieName'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM sous_categorie WHERE nom_sous_cat = :sousCategorieName");
    $stmt->bindParam(':sousCategorieName', $sousCategorieName);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>