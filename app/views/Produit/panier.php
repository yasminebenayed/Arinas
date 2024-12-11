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
  <link rel="stylesheet" type="text/css" href="assests/css/vendor.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="assests/css/style.css">
  <link rel="stylesheet" type="text/css" href="assests/css/list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
<style>
    
  /* Styles pour la section panier */
.panier-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px auto;
  padding: 20px;
  max-width: 1000px;
  background-color: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 2.5rem;
  color: #333;
}

.panier-section a {
  text-decoration: none;
  color: #ffffff;
  margin: 0 20px; /* Augmenter la marge horizontale entre les liens */
  font-weight: bold;
}
.panier-section header a {
  text-decoration: none;
  color: #ffffff;
  margin-right: 20px; /* Ajoute un espace à droite du premier bouton */
  font-weight: bold;
}

.panier-section header a:last-child {
  margin-right: 0; /* Assure que le dernier bouton n'ait pas de marge à droite */
}


.table-panier {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.table-panier th, .table-panier td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: center;
}

.table-panier th {
  background-color: #ddd;
  color: white;
  font-weight: bold;
}

.table-panier tr:nth-child(even) {
  background-color: #f2f2f2;
}

.table-panier tr:hover {
  background-color: #eaf1ff;
}

.table-panier td {
  font-size: 1rem;
  color: #555;
}

/* Styles de base pour les boutons */
/* Conteneur des boutons dans une ligne */
.button-container {
  display: flex; /* Alignement horizontal des enfants */
  justify-content: space-between; /* Espacement entre les boutons */
  gap: 10px; /* Espacement fixe entre les boutons */
}

/* Styles généraux pour les boutons */


/* Bouton "Supprimer" */
.btns-carts {
   
  background-color: #7f3746
  ; /* Rouge pour "Supprimer" */
  display: inline-flex; /* Alignement du texte centré */
    justify-content: center;
    align-items: center;
    height: 30px; /* Ajuste la hauteur du bouton */
    width: 30px; /* Ajuste la largeur pour correspondre à la hauteur */
    color: #fff; /* Couleur du texte */
    border: none; /* Supprime les bordures par défaut */
    border-radius: 5px; /* Rend les boutons parfaitement circulaires */
    cursor: pointer; /* Curseur en mode clic */
    transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Effet de transition */
    font-size: 0.8rem; 
}

.btns-carts:hover {
  background-color: #c82333; /* Rouge foncé au survol */
}

/* Bouton "Ajouter" */
.btns-carts1 {
  background-color: #7f3746  ; /* Vert pour "Ajouter" */
 
  display: inline-flex; /* Alignement du texte centré */
    justify-content: center;
    align-items: center;
    height: 30px; /* Ajuste la hauteur du bouton */
    width: 30px; /* Ajuste la largeur pour correspondre à la hauteur */
    color: #fff; /* Couleur du texte */
    border: none; /* Supprime les bordures par défaut */
    border-radius: 5px; /* Rend les boutons parfaitement circulaires */
    cursor: pointer; /* Curseur en mode clic */
    transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Effet de transition */
    font-size: 0.8rem; 
}

.btns-carts1:hover {
  background-color: #218838; /* Vert foncé au survol */
}

.panier-total {
  margin-top: 20px;
  text-align: center;
  font-size: 1.2rem;
  color: #333;
}

.panier-total .btn {
  padding: 10px 20px;
  background-color: #7f3746
  ;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}

.panier-total .btn:hover {
  background-color: #0056b3;
}

  </style>
</head>

<body>
<?php include"app/views/header.php" ?>

    
  <header>
        <h1 style="font-size: 40px;color:#320000;">Mon Panier</h1>

    </header>
    <section id="new-products-section" class="bg-light py-5">
    <div class="container">
    
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
  <div class="button-container">
    <a href="index.php?action=deletepanier&deletecart=<?= urlencode($produit->code); ?>" class="btns btns-carts">-</a>
    <a href="index.php?action=ajoutpanier&addToCart=<?= urlencode($produit->code); ?>&qte=1" class="btns btns-carts1">+</a>
  </div>
</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="panier-total">
                <h3>Montant Total : <?= number_format($this->model->getMontantTotal($_SESSION["user_id"]), 2) ?> €</h3>
                <a class="btn" href="index.php?action=voirmoncommande">Confirmez votre Commande</a>
            </div>
        <?php else: ?>
            <p>Votre panier est vide.</p>
            <a href="index.php?url=produits" class="btn">Retourner à la boutique</a>
        <?php endif; ?>
    </section>


    <?php include"app/views/footer.php" ?>

  <script src="assests/js/jquery.min.js"></script>
  <script src="assests/js/plugins.js"></script>
  <script src="assests/js/SmoothScroll.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="assests/js/script.min.js"></script>
</body>
</html>
