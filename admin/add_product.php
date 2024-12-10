<?php
require_once("connexionDb.php");

// Check if 'marque' is set and is not empty
if (!empty($_POST['marque'])) {
    $code_marque = $_POST['marque']; // Retrieve marque value

    // Debugging
    var_dump($code_marque);

    // Verify the marque exists in the database
    $req = "SELECT COUNT(*) FROM marque WHERE code = ?";
    $stmt = $pdo->prepare($req);
    $stmt->execute([$code_marque]);
    $exists = $stmt->fetchColumn();

    if ($exists == 0) {
        die("Error: The selected brand (code_marque) does not exist in the database.");
    }
}

// Proceed with your insert query after validating all foreign keys


$req = "SELECT * FROM categorie";
$results = $pdo->query($req);
$categorie = $results->fetchAll(PDO::FETCH_OBJ);
$req1 = "SELECT * FROM marque";
$results1 = $pdo->query($req1);
$marque = $results1->fetchAll(PDO::FETCH_OBJ);
$code = isset($_POST["categorie"]) ? $_POST["categorie"] : null;
$code_sous_cat = isset($_POST["sous_categorie"]) ? $_POST["sous_categorie"] : null;



if (isset($_POST['code'])) {
    $selectedCode = $_POST['code'];

    // Fetch sous_categorie based on the selected code
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $results2 = $pdo->prepare($req2);
    $results2->execute(['code' => $selectedCode]);
    $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);

    // Output the options
    foreach ($sous_cat as $sc) {
        echo "<option value='" . $sc->code . "'>" . $sc->nom_sous_cat . "</option>";
    }

    // Terminate the script after handling the AJAX request
    exit();
}
if (isset($_POST['sous_categorie'])) {
    $selectedsouscat = $_POST['sous_categorie'];
}

$defaultSelectedCode = 1;

$req3 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
$results3 = $pdo->prepare($req3);
$results3->execute(['code' => $defaultSelectedCode]);
$sous_cat = $results3->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <style>
        body {
            background-image: url('../assests/images/photo kbira.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }
        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.8);
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('categorie');
            const subCategorySelect = document.getElementById('sous_categorie');

            categorySelect.addEventListener('change', function () {
                const codeCategorie = this.value;
                fetch('add.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'code=' + codeCategorie
                })
                .then(response => response.text())
                .then(data => {
                    subCategorySelect.innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</head>
<body>
<div class="container">
    <h2>Add a New Product</h2>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <label for="nomProduit">Product Name:</label>
        <input type="text" id="nomProduit" name="nomProduit" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="designation">Designation:</label>
        <textarea id="designation" name="designation" required></textarea>

        <label for="categorie">Category:</label>
        <select id="categorie" name="categorie" required>
            <?php foreach ($categorie as $c): ?>
                <option value="<?= $c->code ?>"><?= htmlspecialchars($c->nomCategorie, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>

        <label for="sous_categorie">Subcategory:</label>
        <select id="sous_categorie" name="sous_categorie" required>
            <?php foreach ($sous_cat as $sc): ?>
                <option value="<?= $sc->code ?>"><?= htmlspecialchars($sc->nom_sous_cat, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>

        <label for="marque">Brand:</label>
        <select id="marque" name="marque" required>
            <?php foreach ($marque as $m): ?>
                <option value="<?= $m->code ?>"><?= htmlspecialchars($m->nomMarque, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>

        <label for="quantite">Quantity:</label>
        <input type="number" id="quantite" name="quantite" required>

        <label for="prix">Price:</label>
        <input type="number" id="prix" name="prix" step="0.01" required>

        <label for="promotion">Promotion:</label>
        <input type="number" id="promotion" name="promotion" step="0.01">

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Add Product</button>
    </form>
</div>
</body>
</html>
