<?php
// Démarrer la session
session_start();

// 1. Vérification de la connexion
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion (index.php)
    header('Location: login.php'); // NOTE: Changé pour 'login.php' si c'est votre page de formulaire
    exit();
}

// 2. Vérification du Rôle Spécifique (Nouveauté pour l'Exercice 1)
if ($_SESSION['username'] !== 'admin') {
    // Si l'utilisateur est connecté mais N'EST PAS l'admin (ex: c'est 'user'),
    // le rediriger vers sa page appropriée ou la page de connexion.
    
    if ($_SESSION['username'] === 'user') {
        header('Location: page_user.php'); // Redirection vers sa page d'utilisateur
    } else {
        header('Location: login.php');
    }
    exit();
}

// L'utilisateur est connecté ET c'est l'administrateur. Accès autorisé.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Administrateur Protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page **ADMINISTRATEUR** de l'atelier 3</h1>
    <p>Vous êtes connecté en tant que : **<?php echo htmlspecialchars($_SESSION['username']); ?>**</p>
    <p style="color: green; font-weight: bold;">Accès accordé : Cette page est réservée aux administrateurs.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
