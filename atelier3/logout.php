<?php
// 1. Démarrer la session (Obligatoire pour accéder aux données et la détruire)
session_start();

// 2. Supprimer les variables de session (réinitialise le compteur et le statut)
session_unset();

// 3. Détruire la session côté serveur
session_destroy();

// 4. Rediriger vers la page de connexion
header('Location: login.php');
exit(); // Assure que le script s'arrête ici
?>
