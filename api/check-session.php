<?php
// Démarre la session pour accéder aux données de session
session_start();

// Déclare que la réponse sera de type JSON
header('Content-Type: application/json');

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Utilisateur connecté : on renvoie les données
    echo json_encode([
        'loggedIn' => true,
        'user' => $_SESSION['user']
    ]);
} else {
    // Utilisateur non connecté
    echo json_encode([
        'loggedIn' => false
    ]);
}
?>
