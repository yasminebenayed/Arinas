
<!DOCTYPE html>
<html lang="fr">

<head>
	
    <meta charset="utf-8">
    <title>Inscription - Arinas</title>
    <link rel="shortcut icon" href="../../../../ARINAS/assests/images/logo.jpg" type="image/x-icon">
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
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Montserrat-Regular", sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('assests/images/base.jpg'); /* Chemin relatif ou URL de l'image */
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.wrapper {
    width: 100%;
    max-width: 800px; /* Largeur maximale du formulaire */
    background-color: rgba(255, 255, 255, 0.85); /* Fond légèrement transparent */
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

h3 {
    font-family: 'Montserrat-SemiBold'; /* Use the semi-bold font */
    color: #511d19; /* Dark brown color */
    font-size: 36px; /* Adjust the font size */
    text-align: center;
    margin-top: 20px; /* Add some margin at the top */
    margin-bottom: 30px; /* Add some margin at the bottom */
    text-transform: uppercase; /* Uppercase letters */
}

.form-holder {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.form-control {
    width: 100%;
    padding: 12px 20px;
    border-radius: 25px;
    border: 1px solid #ddd;
    background-color: #f7f7f7;
    font-size: 16px;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #6b1817;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(107, 24, 23, 0.5);
    outline: none;
}

button {
    padding: 14px 20px;
    background-color: #000;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    margin-left:40%;
}

button:hover {
    background-color:  #ecc440;
}

.checkbox {
    margin-top: 10px;
}

.checkbox label {
    font-size: 14px;
}

.register-link {
    color: #6b1817;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
    margin-top: 20px;
}

.register-link:hover {
    text-decoration: underline;
}

@media (max-width: 767px) {
    .wrapper {
        padding: 20px;
    }

    h3 {
        font-size: 30px;
    }

    .form-holder {
        margin-bottom: 10px;
    }

    .form-control {
        padding: 10px;
        font-size: 14px;
    }

    button {
        font-size: 14px;
        padding: 10px 15px;
    }
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
            <!-- <div class="image-holder">
                <img src="../Arinas/assests/images/logo.jpg" alt="Image d'illustration">
            </div> -->
            <form action="../ARINAS/index.php?action=createuser" method="post">
                <h3>Créer votre compte</h3>
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
                    <button type="submit" name="ajout">Se connecter</button>
                    <p class="mt-3 text-center">Vous avez déjà un compte ? <a href="index.php?action=login" class="register-link">Se connecter</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
