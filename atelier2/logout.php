<?php
session_start();

// 1. Suppression du Cookie (On le met dans le passé pour forcer l'expiration immédiate)
// setcookie(name, value, expire, path, domain, secure, httponly)
setcookie('session_token', '', time() - 3600, '/', '', false, true); 

// 2. Destruction de la session PHP côté serveur
session_unset();  // Supprime les variables de session ($ _SESSION)
session_destroy(); // Détruit le fichier de session

// 3. Redirection vers la page de connexion
header('Location: login.php');
exit;
?>
