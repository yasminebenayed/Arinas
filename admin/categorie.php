
<?php
include('header_actions.php');
require_once("connexionDb.php");

$req = "SELECT * FROM categorie";
$results = $pdo->query($req);
$categories = $results->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Arinas - Beauty & BodyCare</title>
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">

    <!-- CSS Styles -->
    <style>
        /* Body background */
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
            background-color: #bc6c25; /* Dark grey with opacity */
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

        .btn-add-category img {
            max-width: 80%;
            border-radius: 50%;
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
        .btn-delete {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-delete:hover {
    background-color: #c9302c;
}

    </style>
</head>

<body>
    <!-- Main Container -->
    <div >
        

        <!-- Title Section -->
        <div class="transparent-gold-container">
            <h2>Table des catégories</h2>
            <a href="add_categorie.php" title="Add Sous Catégorie" class="btn-add-category">
                <img src="../assests/images/categorie.png" alt="Add Category" />
            </a>
        </div>

        <!-- Table Section -->
        <div>
            <table class="custom-table custom-table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom Catégories</th>
                        <th>Voir les sous-catégories associées</th>
                     
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c->code); ?></td>
                            <td><?= htmlspecialchars($c->nomCategorie); ?></td>
                            <td>
                                <a href="sous_cat.php?category_code=<?= $c->code; ?>" title="View">
                                    <i style="font-size: 1.5em; color: #bc6c25;">&#xE417;</i>
                                </a>
                            </td>
                          

</td>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
         
         
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

</body>

</html>
