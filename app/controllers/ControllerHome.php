<?php

require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../models/ModelUser.php';
require_once __DIR__ . '/../models/Database.php';
class ControllerHome 
{
    private $model;
  
    // public function index()
    // {
    //     //self::loggedOnly();
    //     require_once ('indexproduit.php');
    // }
    public static function loginProcess()
    {
        session_start();
        $db = Database::getInstance()->getConnection();

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $modelUser = new ModelUser($db);

            if (($username == 'admin') && ($password == 'admin')) {
                header("Location: admin/admin.php");
                exit();
            }

            $user = $modelUser->getUserByUsername($username, $password);

            if ($user) {
                $_SESSION['auth'] = $user;
                $_SESSION['user_id'] = $user['code'];
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";

                if (isset($_POST['remember'])) {
                    setcookie("username", $username, time() + (86400 * 30), "/");
                    setcookie("password", $password, time() + (86400 * 30), "/");
                } else {
                    setcookie("username", "", time() - 3600, "/");
                    setcookie("password", "", time() - 3600, "/");
                }

                header("Location: indexproduit.php");
                exit();
            } else {
                $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
                header('Location: ../ARINAS/app/views/Home/login.php');
                exit();
            }
        }
    }
    public static function login()
    {
        include("../../../ARINAS/indexlogin.php");
    }

    public function createProcess()
    {
        // session_start();
         $db = Database::getInstance()->getConnection();

        if (!empty($_POST)) {
            $errors = array();
            $modelUser = new ModelUser($db);

            if (empty($_POST['password'])) {
                $errors['password'] = "Vous devez rentrer un mot de passe valide";
            }

            if (empty($errors)) {
                $data = [
                    'nom' => $_POST["name"],
                    'mail' => $_POST["mail"],
                    'mot_passe' => $_POST["password"],
                    'tel' => $_POST["tel"],
                    'adresse' => $_POST['adress'],
                ];
                

                
                $userCreated = $modelUser->create($data);
              
                header("Location: indexproduit.php");

                
                    // Récupérez les informations complètes de l'utilisateur nouvellement créé.
                    $user = $modelUser->find($userCreated); // Implémentez cette méthode dans votre modèle.
                    session_start();
                    // Stockez les données nécessaires dans la session.
                    $_SESSION['auth'] = $user;
                    $_SESSION["user_id"] = $user['code']; // Ou ajustez selon le nom du champ (par ex. `code` si nécessaire).
                    $_SESSION['mail'] = $user['mail'];
                    $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";
                
                    // Redirigez vers une autre page.
                    header("Location: indexproduit.php");
                    exit();
                
            }
        }

        require('app/views/Home/signup.php');
    }
    
    
}

?>