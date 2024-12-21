<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact</title>
  <link rel="shortcut icon" href="../../../../ARINAS/assests/images/logo.jpg" type="image/x-icon">
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
  <?php include "app/views/header.php"; ?>

  <!-- Section Contact -->
  <section class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-4">Contactez-nous</h2>
        <form action="submit_contact.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="firstName" placeholder=""
            value="<?= $_SESSION['nom'] ?>" required>          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="mail" id="firstName" placeholder=""
            value="<?= $_SESSION['mail'] ?>" required>             </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
      </div>
      <div class="col-md-6">
        <h2 class="mb-4">Nos coordonnées</h2>
        <p><strong>Adresse:</strong> 123 Rue Exemple, Sfax, Tunisie</p>
        <p><strong>Email:</strong> contact@arinas.tn</p>
        <p><strong>Téléphone:</strong> +216 50 584 922</p>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12617.455204595183!2d10.165790032660845!3d36.806494731375295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd34c7e1234f6b%3A0xb6d8e01234c56789!2sCentre%20Ville%2C%20Tunis!5e0!3m2!1sen!2stn!4v1687888354720!5m2!1sen!2stn"
          width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <?php include "app/views/footer.php"; ?>

  <script src="../../../../ARINAS/assests/js/jquery.min.js"></script>
  <script src="../../../../ARINAS/assests/js/plugins.js"></script>
  <script src="../../../../ARINAS/assests/js/SmoothScroll.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="../../../../ARINAS/assests/js/script.min.js"></script>
</body>
</html>
