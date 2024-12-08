<?php
require_once("connexionDb.php");

// Fetch categories
$req = "SELECT * FROM categorie";
$results = $pdo->query($req);
$categorie = $results->fetchAll(PDO::FETCH_OBJ);

// Fetch marques
$req1 = "SELECT * FROM marque";
$results1 = $pdo->query($req1);
$marque = $results1->fetchAll(PDO::FETCH_OBJ);

// Fetch default sous_categories for a category
$defaultSelectedCode = 1;
$req3 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
$results3 = $pdo->prepare($req3);
$results3->execute(['code' => $defaultSelectedCode]);
$sous_cat = $results3->fetchAll(PDO::FETCH_OBJ);

// Handle AJAX request for sous_categorie
if (isset($_POST['code'])) {
    $selectedCode = $_POST['code'];
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $results2 = $pdo->prepare($req2);
    $results2->execute(['code' => $selectedCode]);
    $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);

    foreach ($sous_cat as $sc) {
        echo "<option value='" . $sc->code . "'>" . $sc->nom_sous_cat . "</option>";
    }
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ajouter une Catégorie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-image: url('../assests/images/what.jpg'); /* Ensure the path to silk.jpg is correct */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .container {
        background: rgba(0, 0, 0, 0.6); /* Dark overlay for readability */
        padding: 30px;
        border-radius: 10px;
        margin-top: 50px;
        max-width: 800px;
        
    }

    h4 {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #fff;
    }

    .form-group label {
        font-weight: bold;
        color: #fff;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #000;
    }

    .btn-primary {
        background-color: #bc6c25;
        border-color: #dda15e;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 16px;
        position: center;
    }

    .btn-primary:hover {
        background-color: black;
        border-color: #dda15e;
    }

    .btn-danger {
        background-color: #bc6c25;
        border-color: #dda15e;
        color: white;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
    }
    

    .btn-danger:hover {
        background-color: #bc6c25;
        border-color: #dda15e;
    }

    table {
        margin-top: 15px;
        width: 100%;
        color: #fff;
    }

    table thead th {
        background: rgba(255, 255, 255, 0.2);
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table tbody td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
</style>

</head>

<body>
    <div class="container mt-4" style="width: 80%;">
        <h4 class="mb-4">Ajouter une Catégorie</h4>
        <form action="check_category.php" method="POST" enctype="multipart/form-data" id="categoryForm">
            <div class="form-group">
                <label for="categorie">Catégorie à ajouter</label>
                <input type="text" class="form-control" id="categorie" name="categorie">
            </div>
            <div class="form-group">
                <label for="sous_categorie">Sous-Catégories associées</label>
                <input type="text" class="form-control" id="sous_categorie" placeholder="Enter sous-catégorie">
                <button type="button" class="btn btn-primary" onclick="addSousCategory()">Add Sous-Catégorie</button>
            </div>
            <table class="table" id="sousCategoriesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sous-Catégorie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="submit" class="btn-primary ">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        var sousCategories = [];

        function addSousCategory() {
            var sousCategorieValue = $('#sous_categorie').val().trim();
            if (!sousCategorieValue) {
                alert("Veuillez entrer une sous-catégorie.");
                return;
            }
            if (sousCategories.includes(sousCategorieValue)) {
                alert("Cette sous-catégorie existe déjà.");
                return;
            }
            sousCategories.push(sousCategorieValue);

            var newRow = `
                <tr>
                    <td>${sousCategories.length}</td>
                    <td>${sousCategorieValue}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteSousCategory('${sousCategorieValue}')">Delete</button>
                    </td>
                </tr>`;
            $('#sousCategoriesTable tbody').append(newRow);
            $('#sous_categorie').val('');
        }

        function deleteSousCategory(value) {
            sousCategories = sousCategories.filter(item => item !== value);
            updateTable();
        }

        function updateTable() {
            var tbody = $('#sousCategoriesTable tbody').empty();
            sousCategories.forEach((item, index) => {
                var newRow = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteSousCategory('${item}')">Delete</button>
                        </td>
                    </tr>`;
                tbody.append(newRow);
            });
        }

        $('#categoryForm').submit(function (e) {
            if (!$('#categorie').val().trim()) {
                alert("Veuillez remplir le champ 'Catégorie'.");
                e.preventDefault();
                return;
            }
            if (sousCategories.length === 0) {
                alert("Veuillez ajouter au moins une sous-catégorie.");
                e.preventDefault();
                return;
            }
            $('<input>').attr({
                type: 'hidden',
                name: 'sous_categories',
                value: JSON.stringify(sousCategories)
            }).appendTo(this);
        });
    </script>
</body>

</html>
