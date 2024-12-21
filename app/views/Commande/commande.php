
<?php
$code_user = $_SESSION["user_id"];
$db = Database::getInstance()->getConnection();
$req1 = "SELECT * FROM users WHERE code=:code";
$stmt1 = $db->prepare($req1);
$stmt1->execute(['code' => $code_user]);
$user_inf = $stmt1->fetch(PDO::FETCH_ASSOC);
?>



<style>
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .popup-content button {
        margin: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #confirmButton {
        background-color: green;
        color: white;
    }

    #cancelButton {
        background-color: red;
        color: white;
    }


    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .product-image {
        width: 100px;
        height: auto;
        margin-right: 10px;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .cart-column-dark {
        background-color: #fff;
        color: #fff;
    }
</style>
<script src="https://smtpjs.com/v3/smtp.js">
</script>
<title>Votre Commande</title>
<link rel="shortcut icon" href="../../../../ARINAS/assests/images/logo.jpg" type="image/x-icon">
<link href="assests/css/form-validation.css" rel="stylesheet">
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="TemplatesJungle">
  <meta name="keywords" content="ecommerce,fashion,store">
  <meta name="description" content="Bootstrap 5 Fashion Store HTML CSS Template">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../../ARINAS/assests/css/vendor.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="../../../ARINAS/assests/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../../ARINAS/assests/css/list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
</head>

<body>
<?php include"app/views/header.php" ?>
    <br>
    <br>
    <br>
    <div class="row g-3">
        <div class="col-md-5 col-lg-4 order-md-last border p-3">
            <h4 class="d-flex justify-content-between align-items-center mb-3 cart-column-dark">
                <span class="text-primary">Votre Panier</span>
                <span class="badge bg-primary rounded-pill"></span>
            </h4>
            <?php
            $totalPrixPanier = 0;
            ?>
            <ul class="list-group mb-3">
                <?php foreach ($produits as $p): ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">
                                <?php echo $p->nomProduit ?>
                                <img src="<?= $p->img ?>" alt="" class="product-image">
                            </h6>
                            <small class="text-muted">
                                <?php echo $p->nom_cat ?>
                            </small>
                            
                        </div>
                        <div> <small class="text-muted">
                                <?php echo $p->qte ?>
                            </small></div>
                        <span class="text-muted">
                           <small class="text-muted">
                                <?php echo $p->qte ?>
                            </small>
                            
                            <?php echo $p->prix  ?>
                        </span>

                    </li>
                    <?php
                    $totalPrixPanier += $p->prix  * $p->qte;
                endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Frais de livraison(TND)</span>
                    <strong>
                        7
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (TND)</span>
                    <strong>
                        <?php echo $totalPrixPanier + 7 ?>
                    </strong>
                </li>
            </ul>
        </div>
        <div class="col-md-7 col-lg-7 ml-3">
            <h4 class="ml-3">Formulaire de commande</h4>
            <form action="index.php?action=createcommande" method="post"  id="commandeForm">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="firstName" class="form-label">Nom et prénom</label>
                        <input type="text" class="form-control" name="nom" id="firstName" placeholder=""
                            value="<?= $_SESSION["user_id"] ?>" required>
                        <div class="invalid-feedback">Verifier votre nom.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com"
                            value="<?= $user_inf['mail'] ?>">
                        <div class="invalid-feedback">Verifier votre adresse mail.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Addresse</label>
                        <input type="text" name="adresse" class="form-control" id="address" placeholder=""
                            value="<?= $user_inf['adresse'] ?>" required>
                        <div class="invalid-feedback">Donner votre adresse de livraison.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address2" class="form-label">Addresse 2 <span
                                class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="country" class="form-label">Pays</label>
                        <select class="form-control" id="country" name="pays" required>
                            <option value="">Choisir...</option>
                            <option>France</option>
                            <option>Tunisie</option>
                        </select>
                        <div class="invalid-feedback">Veuillez sélectionner un pays valide.</div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="state" class="form-label">Ville</label>
                        <select class="form-control" id="state" name="ville" required>
                            <option value="">Choisir...</option>
                            <option>Sfax</option>
                            <option>Tunis</option>
                            <option>Sousse</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="zip" class="form-label">Code postal</label>
                        <input type="text" class="form-control" id="zip" name="code_postale" placeholder="" required>
                    </div>
                </div>


                <hr class="my-4">

                <h4 class="mb-3">Paiement</h4>
                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                            value="Carte de crédit" required onchange="handlePaymentMethodChange()">
                        <label class="form-check-label" for="credit">Carte de crédit</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input" value="Cache"
                            required onchange="handlePaymentMethodChange()">
                        <label class="form-check-label" for="debit">Cache</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" value="PayPal"
                            required onchange="handlePaymentMethodChange()">
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                </div>

                <!-- Additional credit card fields -->
                <div class="row gy-3" id="creditCardFields" style="display:none;">
                    <!-- Add your credit card fields here -->
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Nom sur la carte</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="">
                        <small class="text-muted">Nom complet tel qu'il apparaît sur la carte</small>
                        <div class="invalid-feedback">
                            Le nom sur la carte est requis
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Date d'expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="">
                        <div class="invalid-feedback">
                            La date d'expiration est requise
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="">
                        <div class="invalid-feedback">
                            Le code de sécurité est requis
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit" name="commander"  onclick="confirmButton"id="commanderButton">Comfirmer le
                    paiement</button>
                <br><br><br><br>
               
            </form>
        </div>
    </div>
</div>
    </main>
    <script src="assests/js/bootstrap.bundle.min.js"></script>

    <script src="assests/js/form-validation.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <?php include"app/views/footer.php" ?>

<script src="./../../ARINAS/assests/js/jquery.min.js"></script>
<script src="./../../ARINAS/assests/js/plugins.js"></script>
<script src="./../../ARINAS/assests/js/SmoothScroll.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="assests/js/script.min.js"></script>
</body>

<script>
    function handlePaymentMethodChange() {
        var creditCardFields = document.getElementById('creditCardFields');
        var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

        if (paymentMethod === 'Carte de crédit') {
            creditCardFields.style.display = 'block';
        } else {
            creditCardFields.style.display = 'none';
        }
    }
</script><script>
// Attacher un événement au bouton de confirmation
const confirmButton = document.getElementById("commanderButton");
const commandeForm = document.getElementById("commandeForm");

confirmButton.addEventListener("click", function() {
    // Afficher un popup de confirmation
    const userConfirmed = confirm("Voulez-vous confirmer votre commande ?");
    
    if (userConfirmed) {
        // Si l'utilisateur confirme, soumettre le formulaire
        alert("Votre commande sera traitée dans 7 jours.");
        commandeForm.submit(); // Soumettre le formulaire
    } else {
        // Si l'utilisateur annule, ne rien faire
        alert("Commande annulée.");
    }
});
</script>


</html>