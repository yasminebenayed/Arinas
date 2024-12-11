<?php
require_once("connexionDb.php");
include('header_actions.php');

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
 /*$req2 = "SELECT * FROM sous_categorie ";
 $results2 = $pdo->query($req2);
 $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);
 var_dump($sous_cat);*/
 

?>

<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<head>
    <meta charset="utf-8" />
    
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">
   
    <style>
 body {
            background-image: url('../assests/images/photo kbira.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }

        /* Container styling */
        .container {
            background: rgba(0, 0, 0, 0.6); /* Dark overlay for readability */
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            display: flex;
    flex-direction: column; /* Stack elements vertically */
    align-items: center; /* Horizontally center the children */
    justify-content: center; 
        }

        /* Header Styling */
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 15px; 
         

        }
        textarea { height: 150px; }
        .error-message { color: red; display: none; }
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #fff;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
            color: white;
            background: rgba(69, 160, 73, 0.5);
            max-width: 600px;
            position: center;
        }

        input[type="file"] {
            padding: 5px;
            background-color: #fff;
        }

        textarea {
            height: 120px;
            resize: vertical;
            color:black;
        }

        /* Error Message Styling */
        .error-message {
            color: red;
            display: none;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        /* Image Styling */
        .form-group img {
            margin-bottom: 15px;
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
  <div class="container mt-4" style="width: 80%; margin: auto;">
    <h2>Ajouter un Produit</h2>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="produit">Produit:</label>
            <input type="text" class="form-control" id="nomProduit" name="nomProduit" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <textarea class="form-control" id="designation" name="designation" required></textarea>
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
            <label for="sous_categorie">Sous-Catégorie:</label>
            <select class="form-control" id="sous_categorie" name="sous_categorie" required>
                <?php
                foreach ($sous_cat as $sc) {
                    $selectedsouscat = ($sc->code == $code_sous_cat) ? "selected" : "";
                    echo "<option value='" . $sc->code . "' $selectedsouscat>" . $sc->nom_sous_cat . "</option>";
                }
                ?>
            </select>
        </div>
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
            <input type="number" class="form-control" id="promo" name="promo" required min="0" max="100" oninput="validatePromo()">
            <div id="promo-error" class="error-message">La promotion doit être entre 0% et 100%.</div>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#categorie').change(function () {
            var selectedCode = $(this).val();

            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: { code: selectedCode },
                success: function (response) {
                    $('#sous_categorie').html(response);
                },
                error: function () {
                    console.log('Error loading sous-categories.');
                }
            });
        });
    });

    function validatePromo() {
        var promoInput = document.getElementById("promo");
        var errorMessage = document.getElementById("promo-error");

        if (promoInput.value < 0 || promoInput.value >= 100) {
            promoInput.style.borderColor = "red";
            errorMessage.style.display = "block";
        } else {
            promoInput.style.borderColor = "";
            errorMessage.style.display = "none";
        }
    }
</script>

           
   
    <!--   Core JS Files   -->
    <script src="../dashboard/assets/js/core/popper.min.js"></script>
    <script src="../dashboard/assets/js/core/bootstrap.min.js"></script>
    <script src="../dashboard/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../dashboard/assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../dashboard/assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</body>

</html>
