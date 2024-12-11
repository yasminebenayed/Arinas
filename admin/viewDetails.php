<?php
require_once("connexionDb.php");
$req2 = "SELECT * FROM details_commande WHERE code_commande = :code_commande";
$stmt = $pdo->prepare($req2);
$stmt->bindParam(':code_commande', $code_commande);
$stmt->execute();
$detailsCommande = $stmt->fetchAll(PDO::FETCH_OBJ);


// Check if the category code is set in the URL
$code_commande = "";
if (isset($_GET['codeUser'])) {
    $code_commande = $_GET['codeUser'];
} else if (isset($_GET['code'])) {
    $code_commande = $_GET['code'];
}

// Get the order details
$req = "SELECT * FROM commande WHERE code = :code_commande ORDER BY date DESC";
$stmt = $pdo->prepare($req);
$stmt->bindParam(':code_commande', $code_commande);
$stmt->execute();
$commande = $stmt->fetch(PDO::FETCH_OBJ);

// Get client details
$code_client = $commande->code_client;
$req1 = "SELECT nom FROM users WHERE code = :code_client";
$stmt = $pdo->prepare($req1);
$stmt->bindParam(':code_client', $code_client);
$stmt->execute();
$nom_client = $stmt->fetch(PDO::FETCH_OBJ);

// Get order details
$req2 = "SELECT * FROM details_commande WHERE code_commande = :code_commande";
$stmt = $pdo->prepare($req2);
$stmt->bindParam(':code_commande', $code_commande);
$stmt->execute();
$detailsCommande = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="../assests/images/favicon.png" type="">
    <title>Arinas- Beauty & BodyCare</title>
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">
    <style>
        /* Style for the modal */
        .body {
            font-family: Arial, sans-serif;
            background-image: url('../assests/images/final.jpg');
        }
        .delete-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .overlay-active {
            overflow: hidden;
            /* Empêche le défilement de la page */
        }

        .overlay-active+.container {
            filter: blur(3px);
            /* Ajustez le flou selon vos préférences */
            pointer-events: none;
            /* Ignore les événements sur les éléments de la page */
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }
    </style>
</head>

<body class="body">
    <main >
        <!-- Navbar -->
        <div >
      
                                    <h2 >
                                        Les Details de la commande de
                                        <?php echo $nom_client->nom ?> Faite à
                                        <?php echo $commande->date ?>
                                    </h2>
                                    <input type="hidden" id="commandCode" value="<?php echo $commande->code?>" />
                                </div>
                       

                            <div >
                               
                                    <table >
                                        <thead style="text-align:center">
                                            <tr>
                                                <th>Nom Produit</th>
                                                <th >Image
                                                </th>
                                                <th >Quantité</th>
                                                <th >Prix</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            foreach ($detailsCommande as $dc) {
                                                $code_produit = $dc->code_produit;
                                                $stmt = $pdo->prepare("SELECT nomProduit,img FROM produit WHERE code = :code_produit");
                                                $stmt->bindParam(':code_produit', $code_produit);
                                                $stmt->execute();
                                                $nom_prod = $stmt->fetch(PDO::FETCH_OBJ);
                                                echo "<tr>";
                                                echo "<td>" . $nom_prod->nomProduit . "</td>";
                                                echo "<td><img src='../" . $nom_prod->img . "' width='80' height='80'></td>";
                                                echo "<td>" . $dc->quantite . "</td>";
                                                echo "<td>" . $dc->sous_total . " Dt</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                     
                                <div>
    <h3>
        Prix Total: &nbsp;
        <?php echo $commande->montant ?> Dt
    </h3>
    <?php
    if ($commande->status === "Accepté") {
        if (isset($_GET['codeUser'])) {
            echo '<strong>Commande Validée</strong>';
        } else {
            echo '<button class="btn btn-primary ml-10" onclick="showAlertAndDisable()">Valider</button>';
        }
    } else {
        if (isset($_GET['codeUser'])) {
            echo '<strong>Commande En Cours</strong> ';
            echo '<button class="btn btn-primary ml-1" onclick="location.href=\'viewDetails.php?code=' . $commande->code . '&codecomm='.isset($_GET['codeUser']).'\'">Gérer commande</button>';
        } else {
            // Form for validating the order
            echo '<form method="POST" action="updateOrderStatus.php" style="display:inline;">';
            echo '<input type="hidden" name="orderId" value="' . $commande->code . '" />';
            echo '<input type="hidden" name="newStatus" value="Accepté" />';
          echo'  <button type="button" class="btn btn-primary ml-10" onclick="validateOrder()">Valider</button>'
?>
<script>
function validateOrder() {
    alert("Commande validée");
    window.location.href = 'commandes.php';
}
</script>

           <?php 
            echo '</form>';
        }
    }
    ?>
</div>

                </div>
            </div>
    </main>

    <script>
        function showAlertAndDisable() {
            alert("Cette Commande est déjà Validée");
            var button = document.querySelector('.btn-primary');
            button.disabled = true; // Disable the button after showing the alert
        }

        function validateCommande() {
            // Assuming the code of the command is stored in a hidden input with ID 'commandCode'
            var codeCommande = document.getElementById('commandCode').value;

            // Redirect to a PHP page to update the status (no AJAX required)
            window.location.href = 'updateOrderStatus.php?orderId=' + encodeURIComponent(codeCommande) + '&newStatus=Accepté';
        }
    </script>

</body>

</html>
