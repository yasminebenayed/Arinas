<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="">
    <link rel="icon" type="image/jpg" href="assests/images/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des commandes</title>
    <style>
         body {
            background-image: url('assests/images/background.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }
        .title {
            text-align: center;
            color: black;
            margin-bottom: 20px;
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
        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            color:black;
        }
        a:hover {
            opacity: 0.8;
        }
        .view-details {
            background-color: rgb(110, 149, 111);
            color:black;
        }
    </style>
</head>
<body>
    <?php include 'HeaderActions.php'; ?>
    <h1 class="title">Historique des commandes</h1>
    <table>
        <thead>
            <tr>
                <th>Code Commande</th>
                <?php if (!isset($_GET['codeUser'])) { ?>
                    <th>Nom Client</th>
                <?php } ?>
                <th>Date</th>
                <th>Montant Total</th>
                <th>Adresse</th>
                <?php if (!isset($_GET['codeUser'])) { ?>
                    <th>Status</th>
                <?php } ?>
                <th>Voir Détails</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= htmlspecialchars($order->code); ?></td>
                    <?php if (!isset($_GET['codeUser'])): ?>
                        <?php
                        $stmt = $pdo->prepare("SELECT nom FROM users WHERE code = :code_client");
                        $stmt->bindParam(':code_client', $order->code_client);
                        $stmt->execute();
                        $client = $stmt->fetch(PDO::FETCH_OBJ);
                        ?>
                        <td><?= $client ? htmlspecialchars($client->nom) : 'Client non trouvé'; ?></td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($order->date); ?></td>
                    <td><?= htmlspecialchars($order->montant); ?> Dt</td>
                    <td><?= htmlspecialchars($order->adresse_livraison); ?></td>
                    <?php if (!isset($_GET['codeUser'])) : ?>
                        <td><?= htmlspecialchars($order->status); ?></td>
                    <?php endif; ?>
                    <td><a href="index.php?action=orderDetails&code=<?= htmlspecialchars($order->code); ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>