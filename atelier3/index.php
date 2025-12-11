<?php
session_start();

// --- Logique du Compteur de Visites (Exercice 2) ---

// Le compteur est stocké en session et persiste tant que la session n'est pas détruite.
if (!isset($_SESSION['visit_count'])) {
    // Si c'est la première visite dans la session, initialiser à 1.
    $_SESSION['visit_count'] = 1;
} else {
    // Si la session existe, incrémenter le compteur à chaque affichage de la page.
    $_SESSION['visit_count']++;
}

$count = $_SESSION['visit_count'];

// Vérifier l'état de connexion pour le lien
$is_authenticated = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Atelier 3</title>
</head>
<body>
    <h1>Accueil de l'Atelier 3</h1>
    
    <p style="font-size: 1.2em; color: navy;">
        Vous avez visité cette page d'accueil **<?php echo $count; ?>** fois.
    </p>
    <hr>

    <h2>Statut de la Session</h2>
    <?php if ($is_authenticated): ?>
        <p style="color: green;">Vous êtes connecté en tant que : **<?php echo $_SESSION['username']; ?>**.</p>
        <p>Allez à <a href="page_admin.php">votre page protégée</a> ou <a href="logout.php">Déconnectez-vous</a>.</p>
    <?php else: ?>
        <p style="color: blue;">Vous n'êtes pas connecté.</p>
        <p>Veuillez vous <a href="login.php">connecter</a> pour accéder aux pages protégées (Ex. 1).</p>
    <?php endif; ?>

    <br>
    <a href="../index.html">Retour à l'accueil général</a>
</body>
</html>
