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
  <link rel="stylesheet" type="text/css" href="../../../../ARINAS/assests/css/vendor.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="../../../../ARINAS/assests/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../../../ARINAS/assests/css/list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
</head>

<body>
  <?php include"app/views/header.php" ?>

  <section id="new-products-section" class="bg-light py-5">
    <div class="container">
        <h1 class="section-title text-center mt-4" data-aos="fade-up" style="font-size: 40px;">Découvrez Nos Produits</h1>
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
            <br>
            <br>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach($produits as $p) { ?>
                <div class="col">
                    <div class="product-item">
                        <!-- Image du produit avec effet zoom -->
                        <div class="image-holder">
                            <a href="#">
                                <img src="<?= htmlspecialchars($p->img); ?>" alt="<?= htmlspecialchars($p->nomProduit); ?>" class="img-fluid">
                            </a>
                            <div class="hover-buttonss">
                              <div  >
                              <a href="index.php?action=ajoutpanier1&addToCart=<?= urlencode($p->code); ?>&qte=1" class="btns btns-carts">Ajouter au panier</a>

                              </div>
                              <div>
                              <a href="#" class="btns btns-favs">Ajouter aux favoris</a>

                              </div>
                            </div>

                        </div>

                        <!-- Contenu du produit -->
                        <div class="banner-content py-4">
                            <h5 class="element-title text-uppercase">
                                <a href="#" class="item-anchor"><?= htmlspecialchars($p->nomProduit); ?></a>
                            </h5>
                            <div class="product-price">
                                <strong>Prix :</strong> <?= number_format($p->prix, 2, ',', ' '); ?> €
                            </div>
                            
                            <div class="btn-left">
                                <a href="index.php?action=detailproduit&produit=<?= urlencode($p->code); ?>" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">
                                    Découvrir Maintenant
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
