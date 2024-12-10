<!DOCTYPE html>
<html lang="fr">

<head>
	
    <meta charset="utf-8">
    <title>Inscription - Arinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
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
            background-color: #F0F0F2;
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
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .image-holder {
            width: 50%;
            height: 100%;
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
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
			padding: 8px 15px; /* Réduit le rembourrage interne */
            border-radius: 25px;
            border: 1px solid #ddd;
            background-color: #f7f7f7;
            font-size: 14px;
        }

        button {
            padding: 14px 20px;
            background-color: #6b1817;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d7b3ae;
        }

        .register-link {
            color: #6b1817;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }

        @media (max-width: 767px) {
            .inner {
                flex-direction: column;
            }

            .image-holder {
                width: 100%;
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="inner">
            <div class="image-holder">
                <img src="../Arinas/assests/images/logo.jpg" alt="Image d'illustration">
            </div>
            <form action="../PHP_Project/indexcreateuser.php" method="post">
                <h3>Inscription</h3>
                <div class="form-holder">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nom complet" required>
                </div>
                <div class="form-holder">
                    <input type="email" name="mail" id="mail" class="form-control" placeholder="Adresse email" required>
                </div>
                <div class="form-holder">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
                </div>
                <div class="form-holder">
                    <input type="text" name="tel" id="tel" class="form-control" placeholder="Numéro de téléphone" required>
                </div>
                <div class="form-holder">
                    <input type="text" name="adress" id="adress" class="form-control" placeholder="Adresse" required>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" required> J'accepte les <a href="#">conditions générales</a>
                    </label>
                </div>
                <div class="form-login">
                    <button type="submit" name="ajout">S'inscrire</button>
                    <p class="mt-3 text-center">Vous avez déjà un compte ? <a href="indexlogin.php" class="register-link">Se connecter</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
