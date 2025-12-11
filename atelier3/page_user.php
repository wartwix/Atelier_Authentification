<?php
// Démarrer la session
session_start();

// 1. Vérification de la connexion
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirige si non connecté
    exit();
}

// 2. Vérification du Rôle Spécifique
if ($_SESSION['username'] !== 'user') {
    // Si l'utilisateur est connecté mais N'EST PAS 'user' (ex: c'est 'admin'),
    // le rediriger vers sa page.
    if ($_SESSION['username'] === 'admin') {
        header('Location: page_admin.php'); 
    } else {
        header('Location: login.php');
    }
    exit();
}

// L'utilisateur est connecté ET c'est l'utilisateur standard. Accès autorisé.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Utilisateur Protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page **UTILISATEUR STANDARD** de l'atelier 3</h1>
    <p>Vous êtes connecté en tant que : **<?php echo htmlspecialchars($_SESSION['username']); ?>**</p>
    <p style="color: green; font-weight: bold;">Accès accordé : Cette page est réservée aux utilisateurs standard.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
