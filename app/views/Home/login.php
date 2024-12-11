<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Arinas - Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assests/css/style.css">
    <style>@font-face {
    font-family: "ElMessiri-SemiBold";
    src: url("../fonts/el_messiri/ElMessiri-SemiBold.ttf");
}
@font-face {
    font-family: "Montserrat-Regular";
    src: url("../fonts/montserrat/Montserrat-Regular.ttf");
}
@font-face {
    font-family: "Montserrat-SemiBold";
    src: url("../fonts/montserrat/Montserrat-SemiBold.ttf");
}

* {
    box-sizing: border-box;
}

body {
    font-family: "Montserrat-Regular";
    margin: 0;
    padding: 0;
    background-color: #F0F0F2; /* Couleur de fond par défaut */
    background-image: url('../../../assests/images/base.jpg'); /* Chemin relatif ou URL de l'image */
    background-size: cover; /* Cette propriété permet à l'image de couvrir tout l'écran */
    background-position: center center; /* Centrer l'image */
    background-repeat: no-repeat; /* Empêche l'image de se répéter */
}


.wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: url("../images/bg-login.jpg") no-repeat center center fixed;
    background-size: cover;
}

.inner {
    display: flex;
    background-color: #fff;
    max-width: 1100px;
    width: 60%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
}

.image-holder {
    width: 50%;
    height: 100%;
    position: relative;
}

.image-holder img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

form {
    width: 50%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

h3 {
    font-family: 'Dancing Script', cursive;
    color: #511d19;
    font-size: 40px;
    text-align: center;
    margin-bottom: 20px;
}

.form-holder {
    margin-bottom: 20px;
    position: relative;
}

.form-control {
    width: 100%;
    padding: 12px 20px;
    border-radius: 25px;
    border: 1px solid #ddd;
    font-size: 14px;
    color: #333;
    background-color: #f7f7f7;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #333;
}

button {
    padding: 14px 20px;
    background-color: #ecc440;
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color:#000 ;
}
.a {
    margin-left: 60px;
    margin-top: 0px;

}
.b {
    margin-left: 40px;
}

.register-link{
    color: #ffffff;
    text-decoration: none;
}
/* Style the title */
h1.section-title {
    font-family: 'Montserrat-SemiBold'; /* Use the semi-bold font */
    color: #511d19; /* Dark brown color */
    font-size: 36px; /* Adjust the font size */
    text-align: center;
    margin-top: 20px; /* Add some margin at the top */
    margin-bottom: 30px; /* Add some margin at the bottom */
    text-transform: uppercase; /* Uppercase letters */
}

/* Adjust form-holder for a better visual */
.form-holder {
    margin-bottom: 20px;
    position: relative;
}

/* Add some additional custom styling for the form */
.form-control {
    width: 100%;
    padding: 12px 20px;
    border-radius: 25px;
    border: 1px solid #ddd;
    font-size: 14px;
    color: #333;
    background-color: #f7f7f7;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #333;
}

/* Adjusting the checkbox styles */
.checkbox label {
    font-size: 14px;
    color: #333;
    display: inline-flex;
    align-items: center;
    margin-bottom: 15px;
}

/* Styling for the "Se souvenir de moi" checkbox */
.checkbox input[type="checkbox"] {
    margin-right: 10px;
}


@media (max-width: 767px) {
    .inner {
        flex-direction: column;
        max-width: 100%;
    }

    .image-holder {
        width: 100%;
        height: 250px;
    }

    form {
        width: 100%;
        padding: 30px;
    }

}
.flash-message {
    color: red;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    padding: 10px;
    text-align: center; /* Centrer le texte horizontalement */
    position: fixed; /* Fixer le message à un endroit de l'écran */
    left: 50%; /* Placer l'élément à 50% de la largeur de l'écran */
    transform: translateX(-50%); /* Centrer exactement en utilisant la moitié de la largeur de l'élément */
    top: 20px; /* Placer le message à 20px du bas de l'écran */
    width: auto; /* Laisser la largeur ajustée au contenu */
    max-width: 100%; /* S'assurer que le message ne dépasse pas la largeur de l'écran */
    z-index: 9999; /* Assurez-vous que le message est au-dessus des autres éléments */
}

</style>
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

    <div class="wrapper">
        <div class="inner">
            <div class="image-holder">
                <img src="../../../../ARINAS/assests/images/logo.jpg" alt="Image d'illustration">
            </div>
            <form action="../../../../ARINAS/indexlogin.php" method="post">
                <!-- Affichage du message flash -->
                <?php if (isset($_SESSION['flash']['danger'])): ?>
                    <div class="flash-message">
                        <?php
                        echo htmlspecialchars($_SESSION['flash']['danger']);
                        unset($_SESSION['flash']['danger']); // Supprime le message après affichage
                        ?>
                    </div>
                <?php endif; ?>
                

            <h1 class="section-title text-center mt-4" data-aos="fade-up">BIENVENU CHEZ PARAPHARMACIE <strong> ARINAS</strong></h1>

                <div class="form-holder">
                    <input type="text" placeholder="E-mail" name="username" class="form-control"
                        value="<?php echo isset($username) ? htmlspecialchars($username) : (isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : ''); ?>" required>
                </div>
                <div class="form-holder">
                    <input type="password" placeholder="Mot de passe" name="password" class="form-control"
                        style="font-size: 15px;"
                        value="<?php echo isset($password) ? htmlspecialchars($password) : (isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : ''); ?>" required>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" <?php if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) echo 'checked'; ?>>
                        Se souvenir de moi
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="form-login">
                    <button name="login" class="a">Se connecter</button>
                    <button  class="b"><a href="../../../../ARINAS/indexcreateuser.php" class="register-link">S'inscrire</a></button>
                </div>
            </form>
        </div>
    </div>

    <script src="assests/js/jquery-3.3.1.min.js"></script>
    <script src="assests/js/main.js"></script>
</body>

</html>
