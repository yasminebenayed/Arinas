<?php
require_once("connexionDb.php");

// Fetch all orders or orders for a specific user if `codeUser` is provided
if (isset($_GET['codeUser'])) {
    $codeUser = $_GET['codeUser'];

    // Fetch orders for a specific user
    $req = "SELECT * FROM commande WHERE code_client = :codeUser";
    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':codeUser', $codeUser);
    $stmt->execute();
    $commande = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Fetch the user's name
    $req1 = "SELECT nom FROM users WHERE code = :code_client";
    $stmt = $pdo->prepare($req1);
    $stmt->bindParam(':code_client', $codeUser);
    $stmt->execute();
    $nom_client = $stmt->fetch(PDO::FETCH_OBJ);
} else {
    // Fetch all orders
    $req = "SELECT * FROM commande";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $commande = $stmt->fetchAll(PDO::FETCH_OBJ);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des commandes</title>
    <style>
         body {
            background-image: url('../assests/images/final.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Page title styling */
       .title {
            font-size: 64px;
            font-weight: bold;
            color: gold;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            text-align: center;
            background: linear-gradient(to right, #b8860b, #8b7500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(139, 69, 19, 0.6); /* Transparent brown */
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

        /* Column title styling */
        th {
            background-color: #730220; /* Brown */
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Row styling */
        tr:nth-child(even) {
            background-color: rgba(255, 215, 0, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 215, 0, 0.3);
        }

        td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Link styling */
        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            color: #000;
        }

        a:hover {
            opacity: 0.8;
        }

        .view-details {
            background-color: #c7522a; /* Dark brown */
            color: white;
        }
    </style>
    
</head>

<body>
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
            <?php foreach ($commande as $c) : ?>
                <tr>
                    <td><?= htmlspecialchars($c->code); ?></td>
                    <?php if (!isset($_GET['codeUser'])): ?>
                        <?php
                        $stmt = $pdo->prepare("SELECT nom FROM users WHERE code = :code_client");
                        $stmt->bindParam(':code_client', $c->code_client);
                        $stmt->execute();
                        $client = $stmt->fetch(PDO::FETCH_OBJ);
                        ?>
                        <td><?= $client ? htmlspecialchars($client->nom) : 'Client non trouvé'; ?></td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($c->date); ?></td>
                    <td><?= htmlspecialchars($c->montant); ?> Dt</td>
                    <td> <?= htmlspecialchars($c->adresse_livraison); ?></td>
                    <?php if (!isset($_GET['codeUser'])) : ?>
                        <td><?= htmlspecialchars($c->status); ?></td>
                    <?php endif; ?>
                    <td><a href="viewDetails.php?code=<?= htmlspecialchars($c->code); ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
<?php
//Deleting via Form:

//For each row in the table, a form is created with a hidden input field containing the sous-catégorie ID.
//The form is submitted via the POST method when the delete button is clicked.
//Confirmation Prompt:
//
//A confirm() dialog ensures the user confirms the deletion before the form is submitted.
//Server-Side Deletion:
//
//The delete POST parameter is captured and used in a prepared statement to securely delete the record from the database.
//Page Redirection:
//
//After deletion, the page is redirected to itself using header("Location: ...") to avoid accidental form resubmissions when the user refreshes the page.
?>