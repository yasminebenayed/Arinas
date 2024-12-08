<?php
require_once("connexionDb.php");


// Retrieve values from the form
$nomProduit = isset($_POST['nomProduit']) ? $_POST['nomProduit'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$designation = isset($_POST['designation']) ? $_POST['designation'] : '';
$code_categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
$code_marque = isset($_POST['marque']) ? $_POST['marque'] : '';
$code_sous_cat = isset($_POST['sous_categorie']) ? $_POST['sous_categorie'] : '';
$prix = isset($_POST['prix']) ? $_POST['prix'] : '';
$promo = isset($_POST['promo']) ? $_POST['promo'] : '';
$qte = isset($_POST['quantite']) ? $_POST['quantite'] : '';
var_dump($code_sous_cat);
var_dump($code_categorie);
// Handle image upload
$img = ''; // Set a default value
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $imgName = $_FILES['image']['name'];
    $imgTmpName = $_FILES['image']['tmp_name'];
    $img = "../assests/images/" . $imgName; // Change the path to the 'uploads' directory
    $img1= "assests/images/" . $imgName;
    // Move the uploaded file to the specified location
    move_uploaded_file($imgTmpName, $img);
}

// Prepare and execute the SQL query to insert data into the database
$sql = "INSERT INTO `produit` (`code`, `nomProduit`, `description`, `designation`, `code_categorie`, `code_marque`, `code_sous_cat`, `prix`, `qte`, `img`, `promotion`) 
        VALUES (NULL, :nomProduit, :description, :designation, :code_categorie, :code_marque, :code_sous_cat, :prix, :qte, :img, :promo)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nomProduit', $nomProduit);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':designation', $designation);
$stmt->bindParam(':code_categorie', $code_categorie);
$stmt->bindParam(':code_marque', $code_marque);
$stmt->bindParam(':code_sous_cat', $code_sous_cat); // Fix the placeholder name here
$stmt->bindParam(':prix', $prix);
$stmt->bindParam(':promo', $promo);
$stmt->bindParam(':qte', $qte);
$stmt->bindParam(':img', $img1);
// Execute the query
$result = $stmt->execute();

// Check for success
if ($result) {
    header("Location: admin.php");
    exit();
} else {
    echo "Error inserting data. Please try again.";
}

?>