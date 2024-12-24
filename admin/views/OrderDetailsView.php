<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="assests/images/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
       body {
            background-image: url('assests/images/background.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }
        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            color: black;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgb(206, 233, 207);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }
        th {
            background-color: rgba(255, 255, 255, 0.9)
            color:black;
            text-transform: uppercase;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.2);
        }
        tr:hover {
            background-color: rgb(206, 233, 207);
        }
        td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color:black;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-primary {
            background-color:rgb(110, 149, 111);
            border-color:rgb(7, 12, 7);
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color:rgb(155, 179, 156);
            border-color:rgb(206, 233, 207);
        }
        .btn-secondary {
            background-color:rgb(155, 179, 156);
            border-color:rgb(206, 233, 207);
        
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            width: 100%;
        }
        .btn-secondary:hover {
            background-color:rgb(110, 149, 111);
            border-color:rgb(7, 12, 7);
        }
    </style>
</head>
<body>
    <?php include 'HeaderActions.php'; ?>
    <div class="container">
        <h2>Les Details de la commande de <?= htmlspecialchars($client->nom) ?> Faite à <?= htmlspecialchars($commande->date) ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Nom Produit</th>
                    <th>Image</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detailsCommande as $dc): ?>
                    <?php
                    $stmt = $pdo->prepare("SELECT nomProduit, img FROM produit WHERE code = :code_produit");
                    $stmt->bindParam(':code_produit', $dc->code_produit);
                    $stmt->execute();
                    $nom_prod = $stmt->fetch(PDO::FETCH_OBJ);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($nom_prod->nomProduit) ?></td>
                        <td><img src="<?= htmlspecialchars($nom_prod->img) ?>" width="80" height="80"></td>
                        <td><?= htmlspecialchars($dc->quantite) ?></td>
                        <td><?= htmlspecialchars($dc->sous_total) ?> Dt</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Prix Total: <?= htmlspecialchars($commande->montant) ?> Dt</h3>
        <div class="btn-container">
            <form method="POST" action="index.php?action=orderDetails">
                <input type="hidden" name="orderId" value="<?= htmlspecialchars($commande->code) ?>">
                <input type="hidden" name="newStatus" value="1">
                <button type="submit" name="updateStatus" class="btn btn-primary">Valider</button>
            </form>
            <form method="POST" action="index.php?action=orderDetails">
                <input type="hidden" name="orderId" value="<?= htmlspecialchars($commande->code) ?>">
                <input type="hidden" name="newStatus" value="0">
                <button type="submit" name="updateStatus" class="btn btn-secondary">Unvalider</button>
            </form>
        </div>
        <?php if ($commande->status === "1"): ?>
            <strong>Commande Validée</strong>
        <?php endif; ?>
    </div>
</body>
</html>