<?php
require_once("connexionDb.php");

// Check if the category code is set in the URL
if (isset($_GET['category_code'])) {
    $categoryCode = $_GET['category_code'];

    // Fetch category
    $req = "SELECT * FROM categorie WHERE code = :categoryCode";
    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':categoryCode', $categoryCode);
    $stmt->execute();
    $cat = $stmt->fetch(PDO::FETCH_OBJ);

    // Fetch sous categories
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :categoryCode";
    $stmt = $pdo->prepare($req2);
    $stmt->bindParam(':categoryCode', $categoryCode);
    $stmt->execute();
    $sous_cat = $stmt->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "Category code not specified.";
    exit();
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $codesouscat = $_POST['delete'];
    $stmt = $pdo->prepare("DELETE FROM sous_categorie WHERE code = :code");
    $stmt->bindParam(':code', $codesouscat);
    $stmt->execute();
    // Redirect to the same page to prevent form resubmission
    header("Location: sous_cat.php?category_code=" . urlencode($categoryCode));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arinas - Beauty & BodyCare</title>
    <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap_prod.css" />
    <style>
        body {
            background-image: url('../assests/images/now.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .transparent-gold-container {
            background-color: rgba(224, 159, 62, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 95%;
            color: #333;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-table th {
            background-color: #bc6c25;
            color: #fff;
            padding: 12px;
            text-transform: uppercase;
        }

        .custom-table td {
            padding: 15px;
            color: #333;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .custom-table-hover tbody tr:hover {
            background-color: rgba(224, 159, 62, 0.3);
            transition: background-color 0.3s ease;
        }

        .delete-button {
            color: brown;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="transparent-gold-container">
        <h2>Sous Catégories de <?php echo htmlspecialchars($cat->nomCategorie); ?></h2>

        <table class="custom-table custom-table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Sous Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sous_cat as $c): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($c->code); ?></td>
                        <td><?php echo htmlspecialchars($c->nom_sous_cat); ?></td>
                        <td>
                            <!-- Delete form for each sous-catégorie -->
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="delete" value="<?php echo htmlspecialchars($c->code); ?>">
                                <button type="submit" class="delete-button" onclick="return confirm('Voulez-vous vraiment supprimer cette sous-catégorie ?');">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


