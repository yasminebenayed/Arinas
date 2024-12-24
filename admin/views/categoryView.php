<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <title>Arinas - Beauty & BodyCare</title>
    <link rel="icon" type="image/jpg" href="assests/images/logo.jpg">
    <style>
        body {
            background-image: url('assests/images/background.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: 'Playfair Display', serif;
           
        }
        .transparent-gold-container {
            background-color: rgb(206, 233, 207);
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 95%;
            color:black;
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            overflow: hidden;
        }
        .custom-table th {
            background-color:rgb(155, 179, 156);
            color:black;
            padding: 12px;
            text-transform: uppercase;
        }
        .custom-table td {
            padding: 15px;
            color: black;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .custom-table-hover tbody tr:hover {
            background-color: rgb(206, 233, 207);
            transition: background-color 0.3s ease;
        }
        .btn-add-category {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: rgba(61, 50, 50, 0.6);
            color: black;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-add-category:hover {
            background-color:rgb(155, 179, 156);
        }
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color:black;
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        .btn-delete {
            background-color: #rgb(155, 179, 156);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-delete:hover {
            background-color: rgb(206, 233, 207);
        }
    </style>
</head>
<body> 
<?php include 'HeaderActions.php'; ?>
    <div class="transparent-gold-container">
        <h2>Table des catégories</h2>
        <div class="title-section">
            <a href="index.php?action=addSousCategorie" title="Add Sous Catégorie" class="btn-add-category">
                Add Sous Catégorie
            </a>  
            <a href="index.php?action=addCategory" title="Add Catégorie" class="btn-add-category">
                Add Catégorie
            </a>
        </div>
    </div>
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
                            <a href="index.php?action=categoryDetails&category_code=<?= htmlspecialchars($c->code); ?>" title="View">
                                <i style="font-size: 1.5em; color: #bc6c25;">&#xE417;</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>