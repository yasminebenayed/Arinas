<?php 
session_start(); // Démarre la session

// Vérifie si une session est ouverte
if (isset($_SESSION['user_id'])) {
    session_unset();  // Supprime toutes les variables de session
    session_destroy(); // Détruit la session
}

// Redirige vers la page de connexion après la déconnexion
header('Location: app/views/Home/login.php');
exit; // Assure que le script s'arrête ici
?>
