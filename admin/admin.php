<?php
require_once("connexionDb.php");

//fetching all the products
$req = "SELECT produit.*, categorie.nomCategorie AS categorie_nom FROM produit
         JOIN categorie ON produit.code_categorie = categorie.code";
$results = $pdo->query($req);
$produits = $results->fetchAll(PDO::FETCH_OBJ);

//handling the delete thing
if (isset($_GET['delete'])) {
    $codeProduit = $_GET['delete'];
    $pdo->exec("DELETE FROM produit WHERE code = $codeProduit");
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assests/images/logo.jpg">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
 
    <title>Product Management</title>
    <style>
       .page-title {
            font-size: 64px;
            font-weight: bold;
            color: gold;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            text-align: center;
            background: linear-gradient(to right, #b8860b, #8b7500); /* Darker gold gradient */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        body {
            font-family: Arial, sans-serif;
            background-image: url('../assests/images/final.jpg');
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 200px;
            text-align: center;
            background:white;
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            margin: 5px;
            display: inline-block;
        }

        .update {
            background-color:brown;
            color: white;
        }

        .delete {
            background-color: black;
            color: white;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }

        .modal.active {
            display: block;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }
    </style>

    <!--  js to make the deleting model work -->
    <script>
        function confirmDelete(codeProduit) {
            document.getElementById("deleteModal").classList.add("active");
            document.getElementById("overlay").classList.add("active");
            document.getElementById("confirmDelete").href = `admin.php?delete=${codeProduit}`;
        }

        function closeModal() {
            document.getElementById("deleteModal").classList.remove("active");
            document.getElementById("overlay").classList.remove("active");
        }
    </script>
</head>

<body>
<h1 class="page-title">Product Management</h1>
    <div class="product-list">
        <?php foreach ($produits as $p) { ?>
            <div class="product-card">
          <img src="<?= '../' . $p->img ?>" alt=""> 
                <h4><?= $p->nomProduit ?></h4>
                <p>Price: <?= $p->prix ?> Dt</p>
                <div class="actions">
                    <a href="update_product.php?update=<?= $p->code ?>" class="update">Update</a>
                    <a href="#" class="delete" onclick="confirmDelete('<?= $p->code ?>')">Delete</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Modal for delete confirmation -->
    <div id="deleteModal" class="modal">
        <p>Are you sure you want to delete this product?</p>
        <a href="#" id="confirmDelete" class="delete">Yes, Delete</a>
        <button onclick="closeModal()">Cancel</button>
    </div>
    <div id="overlay" class="overlay" onclick="closeModal()"></div>
</body>

</html>
