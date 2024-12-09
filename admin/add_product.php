<?php
require_once("connexionDb.php");

$req = "SELECT * FROM categorie";
$results = $pdo->query($req);
$categorie = $results->fetchAll(PDO::FETCH_OBJ);
$req1 = "SELECT * FROM marque";
$results1 = $pdo->query($req1);
$marque = $results1->fetchAll(PDO::FETCH_OBJ);
$code = isset($_POST["categorie"]) ? $_POST["categorie"] : null;
$code_sous_cat = isset($_POST["sous_categorie"]) ? $_POST["sous_categorie"] : null;


//!!!!!!!!!!!!!!!!!!!!!!!__________AJAXXX_____________!!!!!!!!!!!!!!!!!!!!//
if (isset($_POST['code'])) {
    $selectedCode = $_POST['code'];

    // Fetch sous_categorie based on the selected code
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $results2 = $pdo->prepare($req2);
    $results2->execute(['code' => $selectedCode]);
    $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);

    // Output the options
    foreach ($sous_cat as $sc) {
        echo "<option value='" . $sc->code . "'>" . $sc->nom_sous_cat . "</option>";
    }

    // Terminate the script after handling the AJAX request
    exit();
}
if (isset($_POST['sous_categorie'])) {
    $selectedsouscat = $_POST['sous_categorie'];
}

$defaultSelectedCode = 1;

$req3 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
$results3 = $pdo->prepare($req3);
$results3->execute(['code' => $defaultSelectedCode]);
$sous_cat = $results3->fetchAll(PDO::FETCH_OBJ);

//**********************//
/* $req2 = "SELECT * FROM sous_categorie ";
 $results2 = $pdo->query($req2);
 $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);
 var_dump($sous_cat);*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <title>Arinas- Beauty & BodyCare</title>
   
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">
   

    <!-- CSS Files -->



    <link id="pagestyle" href="../dashboard/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <style>
        /* Style for the modal */
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

        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-control {

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

<body class="sub_page">


   
    <!-- product section -->
    <style>
        .product_section .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
            /* Negative margin to offset the margin on the boxes */
        }

        .box {
            flex: 1 0 calc(25% - 20px);
            /* Adjust the width and margin as needed */
            margin: 10px;
            /* Adjust the margin as needed */
        }

        .box img {
            width: 100%;
            height: auto;
            /* Ensure images don't stretch */
        }

        .detail-box {
            text-align: center;
            /* Center-align the text in the detail-box */
        }

        @media (max-width: 1200px) {
            .box {
                flex-basis: calc(33.3333% - 20px);
                /* Adjust the width for medium screens */
            }
        }

        @media (max-width: 992px) {
            .box {
                flex-basis: calc(50% - 20px);
                /* Adjust the width for small screens */
            }
        }

        @media (max-width: 768px) {
            .box {
                flex-basis: calc(100% - 20px);
                /* Adjust the width for extra small screens */
            }
        }
    </style>
    <div class="container mt-4" style="width: 80%;margin:20%">
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="produit">Produit:</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea type="text" class="form-control" id="description" name="description" style="height: 150px;"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="designation">Designation:</label>
                <textarea type="text" class="form-control" id="designation" name="designation" style="height: 150px;"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select class="form-control" id="categorie" name="categorie" required>
                    <?php
                    foreach ($categorie as $c) {
                        $selected = ($c->code == $code) ? "selected" : "";
                        echo "<option value='" . $c->code . "' $selected>" . $c->nomCategorie . "</option>";
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sous_categorie">Sous_Catégorie:</label>
                <select class="form-control" id="sous_categorie" name="sous_categorie" required>
                    <?php
                    foreach ($sous_cat as $sc) {
                        $selectedsouscat = ($sc->code == $code_sous_cat) ? "selected" : "";
                        echo "<option value='" . $sc->code . "'  $selectedsouscat>" . $sc->nom_sous_cat . "</option>";
                    }
                    ?>
                </select>

            </div>


            <script>
                $(document).ready(function () {
                    $('#categorie').change(function () {
                        var selectedCode = $(this).val();

                        // Make an AJAX request to get the sous_categorie options
                        $.ajax({
                            type: 'POST',
                            url: window.location.href,
                            data: { code: selectedCode },
                            success: function (response) {
                                $('#sous_categorie').html(response);
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });
                });
            </script>
            <script>
                var selectedsouscat;
                $(document).ready(function () {
                    $('#sous_categorie').change(function () {
                        selectedsouscat = parseInt($(this).val(), 10);
                    })
                });
            </script>
            <div class="form-group">
                <label for="marque">Marque:</label>
                <select class="form-control" id="marque" name="marque" required>
                    <?php
                    foreach ($marque as $m) {
                        echo "<option value='1'>" . $m->nomMarque . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité en stock:</label>
                <input type="number" class="form-control" id="quantite" name="quantite" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix unitaire:</label>
                <input type="number" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="promo">Promotion:</label>
                <input type="number" class="form-control" id="promo" name="promo" required min="0" max="100"
                    oninput="validatePromo()">
                <div id="promo-error" class="error-message" style="display: none;">La promotion doit etre entre supérieure ou égale à 0% et inférieure 100%</div>
            </div>
            <style>
                .error-message {
                    color: red;
                }
            </style>
            <script>
                function validatePromo() {
                    var promoInput = document.getElementById("promo");
                    var errorMessage = document.getElementById("promo-error");

                    // Trim leading and trailing whitespaces and convert to lowercase
                    var value = promoInput.value.trim().toLowerCase();

                    if (value != "" && (isNaN(value) || value < 0 || value >= 100)) {
                        promoInput.style.borderColor = "red";
                        errorMessage.style.display = "block";
                    } else {
                        promoInput.style.borderColor = ""; // Reset border color
                        errorMessage.style.display = "none"; // Hide error message
                    }
                }
            </script>
            

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