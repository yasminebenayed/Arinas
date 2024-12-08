<?php
// $pdo = new PDO("mysql:host=localhost;dbname=arinas", "root", "");

// if (isset($_POST['categorie'])) {
//     $categorie = $_POST['categorie'];
//     $sousCategories = $_POST['sousCategories'];
//     // Check if the categorie already exists
//     $stmt = $pdo->prepare("SELECT COUNT(*) FROM categorie WHERE nomCategorie = ?");
//     $stmt->execute([$categorie]);
//     $count = $stmt->fetchColumn();
//     print_r($sousCategories)
//     if ($count > 0) {
//         // Category exists
//         echo 'exists';
//     } else {
//         // Category does not exist
//         echo 'not_exists';
//     }
// }
?>
<!-- <!DOCTYPE html>
<html>

<body>
    <h1>
    </h1>

</body>

</html> -->
<?php
require_once("connexionDb.php");


if (isset($_POST['categorie'])) {
    $categorie = $_POST['categorie'];
    $sousCategories = $_POST['sous_categories'];
    // Check if the categorie already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categorie WHERE nomCategorie = ? ");
    $stmt->execute([$categorie]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Category exists
    } else {
        // Category does not exist
        // Process sousCategories array
        // Process sousCategories array
// Process sousCategories array
        // Process sousCategories array
        if (!empty($sousCategories)) {
            // Decode the JSON string to get the array
            $sousCategoriesArray = json_decode($sousCategories, true);

            // Check if decoding was successful
            if ($sousCategoriesArray !== null) {
                // For example, convert it to a comma-separated string and store it in the database
                $sousCategoriesString = implode(", ", $sousCategoriesArray);

                // Separate the values into an array
                $individualSousCategories = explode(", ", $sousCategoriesString);

                // Now, $individualSousCategories is an array containing individual values
                //var_dump($individualSousCategories[0]);

                // Insert the categorie and sousCategories into the database
                $insertCategorieStmt = $pdo->prepare("INSERT INTO categorie (nomCategorie) VALUES (?)");
                $insertCategorieStmt->execute([$categorie]);
                $categorieCode = $pdo->lastInsertId();
                
                // Insert each sous_categorie into the database
                foreach ($individualSousCategories as $nomSousCategorie) {
                    $insertSousCategorieStmt = $pdo->prepare("INSERT INTO sous_categorie (nom_sous_cat, code_categorie) VALUES (?, ?)");
                    $insertSousCategorieStmt->execute([$nomSousCategorie, $categorieCode]);
                }
                header("Location: categorie.php");

            } else {
                // Handle the case where JSON decoding fails
                echo 'Invalid sousCategories data';
            }
        } else {
            // If there are no sousCategories, simply insert the categorie
            $insertStmt = $pdo->prepare("INSERT INTO categorie (nomCategorie) VALUES (?)");
            $insertStmt->execute([$categorie]);
            $newcat = $insertStmt->fetchColumn();
        }




        echo 'not_exists';
    }
}
?>