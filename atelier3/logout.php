<?php
// Démarrer la session
session_start();

// 1. Suppression des variables de session
// Ceci est essentiel pour réinitialiser le compteur de visites (Exercice 2)
// et le statut de connexion (Exercice 1).
session_unset();

// 2. Destruction de la session PHP côté serveur
// Ceci est la destruction finale des données de session.
session_destroy();

// 3. Rediriger vers la page de connexion (pour l'Atelier 3, c'est 'login.php')
// Redirection vers la page contenant le formulaire de connexion.
header('Location: login.php'); 
exit();
?>
