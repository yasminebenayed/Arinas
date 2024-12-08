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
    $pdo->exec("DELETE FROM sous_categorie WHERE code = $codesouscat");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arinas - Beauty & BodyCare</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap_prod.css" />
    <!-- Custom styles -->
    <style>
        body {
            background-image: url('../assests/images/now.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Transparent Gold Container */
        .transparent-gold-container {
            background-color: rgba(224, 159, 62, 0.8); /* Gold with 80% opacity */
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 95%;
            color: #333;
        }

        /* Table Styles */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.9); /* Light background */
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-table th {
            background-color: #bc6c25; /* Gold background */
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
            background-color: rgba(224, 159, 62, 0.3); /* Hover effect with gold */
            transition: background-color 0.3s ease;
        }

        /* Add Category Button */
        .btn-add-category {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            background-color: #bc6c25;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-add-category:hover {
            background-color: #dda15e;
        }

        .delete-button {
            color: brown;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }

        /* Title Section */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            margin-bottom: 20px;
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
        <div class="title-section">
            <h2>Sous Catégories de <?php echo htmlspecialchars($cat->nomCategorie); ?></h2>
            <!-- Add Category Button -->
            <div class="btn-add-category" onclick="openModal()">
                <i class="fas fa-plus"></i>
            </div>
        </div>

        <!-- Add Sous Categorie Modal -->
        <div id="addSousCategorieModal" style="display:none;" class="modal-container">
            <form method="post">
                <h3>Ajouter une Sous Catégorie</h3>
                <div class="form-group">
                    <label for="sousCategorieName">Nom de la Sous Catégorie</label>
                    <input type="text" id="sousCategorieName" name="sousCategorieName" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Ajouter</button>
                <button type="button" onclick="closeModal()" class="btn btn-danger">Annuler</button>
            </form>
        </div>

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
                            <a href="#" class="delete-button" onclick="deleteSousCategorie(<?php echo $c->code; ?>)">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function openModal() {
            document.getElementById("addSousCategorieModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("addSousCategorieModal").style.display = "none";
        }

        function deleteSousCategorie(code) {
            if (confirm("Voulez-vous vraiment supprimer cette sous catégorie ?")) {
                $.ajax({
                    type: 'POST',
                    url: 'sous_cat.php?category_code=<?php echo $categoryCode; ?>',
                    data: { delete: code },
                    success: function() {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
