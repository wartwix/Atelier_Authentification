<?php
session_start();

// Vérification de la session
// Si l'utilisateur n'est pas connecté OU que l'utilisateur n'est pas 'admin'
if (!isset($_SESSION['authenticated']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Vérification de la validité du cookie (s'assurer qu'il correspond au jeton stocké en session)
// Si le cookie est manquant ou ne correspond pas au jeton stocké, on déconnecte
if (!isset($_COOKIE['session_token']) || $_COOKIE['session_token'] !== $_SESSION['auth_token']) {
    header('Location: logout.php'); // Déconnexion automatique si le cookie a expiré/été modifié
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tableau de Bord Admin</title>
</head>
<body>
    <h1>Bienvenue sur votre Tableau de Bord, **admin** !</h1>
    <p>Ceci est une page protégée. Votre session expire dans 1 minute (Exercice 1).</p>
    <p><a href="logout.php">Déconnexion</a></p>
</body>
</html>
