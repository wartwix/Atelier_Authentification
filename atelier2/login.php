<?php
// Démarrer la session PHP pour stocker l'état de connexion de l'utilisateur
session_start();

// Définition des utilisateurs et de leurs mots de passe (Simulés, idéalement stockés hachés)
$users = [
    'admin' => 'admin',          // Pour le dashboard.php
    'user' => 'utilisateur'      // Pour le page_user.php (Ex. 3)
];

$error = null;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification des identifiants
    if (isset($users[$username]) && $users[$username] === $password) {
        
        // --- Exercice 2 : Génération du jeton unique ---
        // bin2hex(random_bytes(16)) génère une chaîne aléatoire sécurisée de 32 caractères.
        $token_value = bin2hex(random_bytes(16));
        
        // --- Exercice 1 : Expiration à 1 minute (60 secondes) ---
        $expiry_time = time() + 60; 
        
        // 1. Stockage des informations d'authentification en SESSION
        // C'est le moyen le plus sûr de stocker l'identité côté serveur.
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['auth_token'] = $token_value; 

        // 2. Création du Cookie
        // Le cookie stocke le jeton pour lier le navigateur à la session sur le serveur.
        // setcookie(name, value, expire, path, domain, secure, httponly)
        setcookie('session_token', $token_value, $expiry_time, '/', '', false, true); 
        
        // 3. Redirection vers la page appropriée
        if ($username === 'admin') {
            header('Location: dashboard.php');
        } else {
            header('Location: page_user.php'); // Redirection vers la page de l'Ex. 3
        }
        exit;

    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion par Session/Cookie</h1>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
