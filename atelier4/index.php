<?php
// --- CORRECTIF SPECIAL FASTCGI/ALWAYS.DATA ---
// Si les variables sont vides mais que le header Authorization existe, on les remplit nous-mêmes
if (empty($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    // Le header est au format "Basic base64(user:pass)". On extrait et on décode "user:pass".
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}
// ----------------------------------------------

// 1. Définition des identifiants valides pour l'Atelier 4
$valid_users = [
    'admin' => 'secret',          // Rôle Administrateur
    'user' => 'utilisateur'       // Rôle Utilisateur standard
];

$authenticated = false;
$username = $_SERVER['PHP_AUTH_USER'] ?? '';
$password = $_SERVER['PHP_AUTH_PW'] ?? '';
$is_admin = false;

// 2. Vérification des identifiants
if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
    $authenticated = true;
    if ($username === 'admin') {
        $is_admin = true;
    }
}

// 3. Demander l'authentification si la vérification échoue
if (!$authenticated) {
    // Ceci déclenche la pop-up d'authentification Basic Auth dans le navigateur
    header('WWW-Authenticate: Basic realm="Zone Secrete Atelier 4"');
    header('HTTP/1.0 401 Unauthorized');
    
    // Message affiché si l'utilisateur annule ou échoue la connexion
    echo 'Authentification requise. Accès refusé.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 4 - Affichage par Rôle (Headers HTTP)</title>
</head>
<body style="font-family: sans-serif;">
    
    <div style="max-width: 600px; margin: 50px auto; padding: 20px; border-radius: 10px;">
        <h1 style="color: #006064;">Connexion Réussie !</h1>
        <p>Connecté en tant que : <strong><?php echo htmlspecialchars($username); ?></strong> (via Header HTTP).</p>
        <hr>

        <?php if ($is_admin): ?>
            
            <div style="border: 2px solid red; padding: 15px; background-color: #ffebeb;">
                <h3>🔑 Section Réservée à l'Administrateur (ADMIN)</h3>
                <p>Ceci est une information **confidentielle**. Seul le profil `admin` peut la voir.</p>
                <ul>
                    <li>**Header de Requête :** `Authorization`</li>
                    <li>**Header de Réponse :** `WWW-Authenticate`</li>
                </ul>
            </div>
            
        <?php else: ?>
            
            <div style="border: 2px solid blue; padding: 15px; background-color: #ebf5ff;">
                <h3>🧑 Section Utilisateur Standard (USER)</h3>
                <p>Bienvenue **<?php echo htmlspecialchars($username); ?>**. Vous accédez au contenu public du site.</p>
                <p>Le fait que cette section soit affichée prouve que l'authentification a réussi pour un rôle non-admin.</p>
            </div>
            
        <?php endif; ?>

    </div>
</body>
</html>
