<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../../PHP/PHP_Project/assests/css/style.css">
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="TemplatesJungle">
  <meta name="keywords" content="ecommerce,fashion,store">
  <meta name="description" content="Bootstrap 5 Fashion Store HTML CSS Template">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../../../Arinas/assests/css/vendor.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="../../../../ARINAS/assests/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../../../ARINAS/assests/css/list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">

</head>
<body>
<?php include"app/views/header.php" ?>

    <section id="new-products-section"class="bg-light py-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="../../../PHP/PHP_Project/<?= htmlspecialchars($productDetails->img); ?>" alt="<?= htmlspecialchars($productDetails->nomProduit); ?>" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1 class="product-title"><?= htmlspecialchars($productDetails->nomProduit); ?></h1>
                    <h2 class="product-title">Catégorie :<strong><?= htmlspecialchars($cat); ?></strong></h2>

                    <p class="product-description"><?= nl2br(htmlspecialchars($productDetails->description)); ?></p>
                    <p class="product-description"><?= nl2br(htmlspecialchars($productDetails->designation)); ?></p>

                    <p class="product-price"><strong>Prix :</strong> <?= number_format($productDetails->prix, 2, ',', ' '); ?> €</p>
                    <a  class="btns" href="indexajoutpanier.php?addToCart=<?= urlencode($productDetails->code); ?>&qte=1" class="btns btns-carts">Ajouter au panier</a>

                              </div>
            </div>
        </div>
    </section>

    <?php include"app/views/footer.php"; ?>

<script src="../../../../ARINAS/assests/js/jquery.min.js"></script>
<script src="../../../../ARINAS/assests/js/plugins.js"></script>
<script src="../../../../ARINAS/assests/js/SmoothScroll.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="assests/js/script.min.js"></script>
</body>
</html>
