<?php
// 1. Démarrer la session : Essentiel pour pouvoir manipuler les données et la détruire.
session_start();

// En-têtes pour prévenir le cache des pages de déconnexion/sécurité (bonne pratique)
header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date passée

// 2. Suppression des variables de session (Ex: 'visit_count', 'username')
session_unset();

// 3. Destruction de la session PHP côté serveur
session_destroy();

// 4. Rediriger vers la page de connexion
header('Location: login.php');
exit();
?>
