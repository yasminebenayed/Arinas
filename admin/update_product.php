<?php
require_once("connexionDb.php");

// Récupérer toutes les catégories
$reqCategories = "SELECT * FROM categorie";
$stmtCategories = $pdo->query($reqCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_OBJ);

// Récupérer toutes les marques
$reqMarque = "SELECT * FROM marque";
$stmtMarque = $pdo->query($reqMarque);
$marque = $stmtMarque->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['code'])) {
    $selectedCode = $_POST['code'];
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $results2 = $pdo->prepare($req2);
    $results2->execute(['code' => $selectedCode]);
    $sousCategories = $results2->fetchAll(PDO::FETCH_OBJ);

    foreach ($sousCategories as $sc) {
        echo "<option value='" . $sc->code . "'>" . $sc->nom_sous_cat . "</option>";
    }
    exit(); 
}

// Get Product Details for Update
$codeProduit = $_GET['update'] ?? null;
if ($codeProduit) {
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE code = :code");
    $stmt->bindParam(':code', $codeProduit);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_OBJ);

    // Fetch related sous-categories
    $reqSousCategorie = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $stmt = $pdo->prepare($reqSousCategorie);
    $stmt->bindParam(':code', $produit->code_categorie);
    $stmt->execute();
    $sousCategories = $stmt->fetchAll(PDO::FETCH_OBJ);
}

// Handle Product Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $codeProduit) {
    $formData = [
        'nomProduit' => $_POST['nomProduit'],
        'categorie' => $_POST['categorie'],
        'sous_categorie' => $_POST['sous_categorie'],
        'quantite' => $_POST['quantite'],
        'prix' => $_POST['prix'],
        'promo' => $_POST['promo'],
        'description' => $_POST['description'],
        'designation' => $_POST['designation'],
        'marque' => $_POST['marque'],
        'image' => $produit->img,
    ];

    if ($_FILES['image']['error'] === 0) {
        $imagePath = "assets/images/" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $formData['image'] = $imagePath;
    }

    $stmtUpdate = $pdo->prepare("
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

    if ($stmtUpdate->rowCount() > 0) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assests/images/logo.jpg">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Arinas - Beauty & BodyCare</title>
    <style>
        /* Styles for the form */
        body {
            background-image: url('../assests/images/photo kbira.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }

        /* Container styling */
        .container {
            background: rgba(0, 0, 0, 0.6); /* Dark overlay for readability */
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            display: flex;
    flex-direction: column; /* Stack elements vertically */
    align-items: center; /* Horizontally center the children */
    justify-content: center; 
        }

        /* Header Styling */
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 15px; 
         

        }
        textarea { height: 150px; }
        .error-message { color: red; display: none; }
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #fff;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
            color: white;
            background: rgba(69, 160, 73, 0.5);
            max-width: 600px;
            position: center;
        }

        input[type="file"] {
            padding: 5px;
            background-color: #fff;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        /* Error Message Styling */
        .error-message {
            color: red;
            display: none;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        /* Image Styling */
        .form-group img {
            margin-bottom: 15px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Espace Admin</h2>
        <form action="update_product.php?update=<?= $produit->code ?>" method="POST" enctype="multipart/form-data">
            <!-- Product Details -->
            <div class="form-group">
                <label for="nomProduit">Nom de produit:</label>
                <input type="text" id="nomProduit" name="nomProduit" value="<?= $produit->nomProduit ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= $produit->description ?></textarea>
            </div>
            <div class="form-group">
                <label for="designation">Designation:</label>
                <textarea id="designation" name="designation" required><?= $produit->designation ?></textarea>
            </div>
           
            <div class="form-group">
    <label for="categorie">Catégorie:</label>
    <select id="categorie" name="categorie" required>
        <option value="">Sélectionnez une catégorie</option>
        <?php foreach ($categories as $c): ?>
            <option value="<?= htmlspecialchars($c->code) ?>" 
                <?= $c->code == $produit->code_categorie ? 'selected' : '' ?>>
                <?= htmlspecialchars($c->nomCategorie) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

         
           
            <!-- Additional Fields -->
            <div class="form-group">
    <label for="marque">Marque:</label>
    <select id="marque" name="marque" required>
        <option value="">Sélectionnez une marque</option>
        <?php foreach ($marque as $m): ?>
            <option value="<?= htmlspecialchars($m->code) ?>" 
                <?= $m->code == $produit->code_marque ? 'selected' : '' ?>>
                <?= htmlspecialchars($m->nomMarque) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

            <div class="form-group">
                <label for="quantite">Quantité en stock:</label>
                <input type="number" id="quantite" name="quantite" value="<?= $produit->qte ?>" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix unitaire:</label>
                <input type="number" id="prix" name="prix" value="<?= $produit->prix ?>" required>
            </div>
            <div class="form-group">
                <label for="promo">Promotion:</label>
                <input type="number" id="promo" name="promo" value="<?= $produit->promotion ?>" required>
                <div id="promo-error" class="error-message">Promo should be less than 100.</div>
            </div>
            <div class="form-group">
                <img src="<?= '../' . $produit->img ?>" alt="Image" width="70" height="70">
        </br>
                <label for="image">New image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>
