<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kaira - Bootstrap 5 Fashion Store HTML CSS Template</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="TemplatesJungle">
  <meta name="keywords" content="ecommerce,fashion,store">
  <meta name="description" content="Bootstrap 5 Fashion Store HTML CSS Template">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../../PHP/PHP_Project/assests/css/vendor.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="../../../PHP/PHP_Project/assests/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../../PHP/PHP_Project/assests/css/list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
</head>

<body>
<?php include"app/views/header.php" ?>

  <header>
        <h1>Mon Panier</h1>
        <a href="indexproduit.php">Retourner à la boutique</a>
        <a href="indexcreatecommande.php">Commander</a>

    </header>
    
    <section class="panier-section">
        <?php if (!empty($produits)): ?>
            <table class="table-panier">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit): ?>
                        <tr>
                            <td><?= htmlspecialchars($produit->nomProduit) ?></td>
                            <td><?= htmlspecialchars($produit->nom_cat) ?></td>
                            <td><?= number_format($produit->prix, 2) ?> €</td>
                            <td><?= htmlspecialchars($produit->qte) ?></td>
                            <td><?= number_format($produit->prix * $produit->qte, 2) ?> €</td>
                            <td>
                                <a href="indexdeletepanier.php?deletecart=<?= urlencode($produit->code); ?>" class="btns btns-carts">Supprimer</a>
                                <a href="indexajoutpanier.php?addToCart=<?= urlencode($produit->code); ?>&qte=1" class="btns btns-carts">Ajouter</a>

                              
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="panier-total">
                <h3>Montant Total : <?= number_format($this->model->getMontantTotal($_SESSION["user_id"]), 2) ?> €</h3>
                <a class="btn" href="index.php?url=checkout">Passer à la caisse</a>
            </div>
        <?php else: ?>
            <p>Votre panier est vide.</p>
            <a href="index.php?url=produits" class="btn">Retourner à la boutique</a>
        <?php endif; ?>
    </section>



    <?php include"app/views/footer.php" ?>

  <script src="./../../PHP/PHP_Project/assests/js/jquery.min.js"></script>
  <script src="./../../PHP/PHP_Project/assests/js/plugins.js"></script>
  <script src="./../../PHP/PHP_Project/assests/js/SmoothScroll.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="assests/js/script.min.js"></script>
</body>
</html>
