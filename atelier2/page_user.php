<?php
session_start();

// 1. Vérification générale de la connexion
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}

// 2. Vérification spécifique de l'utilisateur (Exigence de l'Exercice 3)
if ($_SESSION['username'] !== 'user') {
    // Si un autre utilisateur (ex: admin) tente d'accéder, on le redirige.
    header('Location: dashboard.php'); 
    exit;
}

// Vérification du cookie pour la validité de la session (similaire à dashboard.php)
if (!isset($_COOKIE['session_token']) || $_COOKIE['session_token'] !== $_SESSION['auth_token']) {
    header('Location: logout.php'); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page Utilisateur</title>
</head>
<body>
    <h1>Bienvenue, **user** !</h1>
    <p>Cette page est uniquement accessible par l'utilisateur 'user' (mot de passe : 'utilisateur').</p>
    <p><a href="logout.php">Déconnexion</a></p>
</body>
</html>
