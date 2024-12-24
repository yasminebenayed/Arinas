<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/images/logo.jpg">
    <title>Arinas - Beauty & BodyCare</title>
    <link rel="stylesheet" type="text/css" href="assests/css/bootstrap_prod.css" />
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
            background-colorrgb(155, 179, 156);
            color: black;
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
            background-color: rgb(206, 233, 207);
            transition: background-color 0.3s ease;
        }
        .delete-button {
            color: black;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include 'HeaderActions.php'; ?>
    <div class="transparent-gold-container">
        <h2>Sous Catégories de <?= htmlspecialchars($category->nomCategorie); ?></h2>
        <table class="custom-table custom-table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Sous Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subCategories as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c->code); ?></td>
                        <td><?= htmlspecialchars($c->nom_sous_cat); ?></td>
                        <td>
                        <form method="POST" action="index.php?action=deleteSubCategory" onsubmit="return confirm('Voulez-vous vraiment supprimer cette sous-catégorie ?');">
                                <input type="hidden" name="sub_category_code" value="<?= htmlspecialchars($c->code); ?>">
                                <button type="submit" class="delete-button">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>