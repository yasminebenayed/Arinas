<?php
require_once("connexionDb.php");

// Validate 'marque'
if (!empty($_POST['marque'])) {
    $code_marque = $_POST['marque'];

    $req = "SELECT COUNT(*) FROM marque WHERE code = ?";
    $stmt = $pdo->prepare($req);
    $stmt->execute([$code_marque]);
    $exists = $stmt->fetchColumn();

    if ($exists == 0) {
        die("Error: The selected brand does not exist in the database.");
    }
}

// Handle AJAX request for subcategory
if (isset($_POST['code'])) {
    $selectedCode = $_POST['code'];

    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $stmt = $pdo->prepare($req2);
    $stmt->execute(['code' => $selectedCode]);
    $sous_cat = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($sous_cat as $sc) {
        echo "<option value='" . $sc->code . "'>" . htmlspecialchars($sc->nom_sous_cat, ENT_QUOTES, 'UTF-8') . "</option>";
    }
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomProduit = htmlspecialchars($_POST['nomProduit'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $designation = htmlspecialchars($_POST['designation'], ENT_QUOTES, 'UTF-8');
    $categorie = $_POST['categorie'];
    $sous_categorie = $_POST['sous_categorie'];
    $marque = $_POST['marque'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $promotion = $_POST['promotion'];

    // Handle file upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            die("Error uploading the image.");
        }
    }

    // Insert into database (example query)
   // Insert into database
$insertQuery = "INSERT INTO produit (nomProduit, description, designation, code_categorie, code_sous_cat, code_marque, prix, qte, img, promotion) 
VALUES (:nomProduit, :description, :designation, :code_categorie, :code_sous_cat, :code_marque, :prix, :qte, :img, :promotion)";

$stmt = $pdo->prepare($insertQuery);

try {
    $stmt->execute([
        'nomProduit' => $nomProduit,
        'description' => $description,
        'designation' => $designation,
        'code_categorie' => $categorie,
        'code_sous_cat' => $sous_categorie,
        'code_marque' => $marque,
        'prix' => $prix,
        'qte' => $quantite,
        'img' => $imagePath,
        'promotion' => $promotion
    ]);

    echo "<script>
        alert('Product added successfully!');
        setTimeout(function() {
            window.location.href = 'admin.php';
        }, 2000);
    </script>";
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage()); // Log the exact error
    echo "<script>
        alert('Error adding product: Check logs for details.');
        setTimeout(function() {
            window.location.href = 'admin.php';
        }, 2000);
    </script>";
}
}

// Fetch categories and brands
$req = "SELECT * FROM categorie";
$categorie = $pdo->query($req)->fetchAll(PDO::FETCH_OBJ);

$req1 = "SELECT * FROM marque";
$marque = $pdo->query($req1)->fetchAll(PDO::FETCH_OBJ);

// Default subcategory options
$defaultSelectedCode = $categorie[0]->code ?? 1;
$req3 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
$stmt = $pdo->prepare($req3);
$stmt->execute(['code' => $defaultSelectedCode]);
$sous_cat = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
