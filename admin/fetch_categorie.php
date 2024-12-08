<?php
require_once("connexionDb.php");

if (isset($_GET['category_code'])) {
    $categoryCode = $_GET['category_code'];
 // Use a prepared statement to prevent SQL injection
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :categoryCode";
    $stmt = $pdo->prepare($req2);
    $stmt->bindParam(':categoryCode', $categoryCode);
    $stmt->execute();

    $sous_cat = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Output the updated table content
    foreach ($sous_cat as $sous) {
        echo "<tr>";
        echo "<td>" . $sous->code . "</td>";
        echo "<td>" . $sous->nom_sous_cat . "</td>";
        echo "<td>";
        echo "<a href='' class='delete-btn view' title='Delete' data-toggle='tooltip' data-code='" . $sous->code . "'><i class='material-icons'>&#xE872;</i></a>";
        echo "</td>";

        echo "</tr>";
    }
}
?>