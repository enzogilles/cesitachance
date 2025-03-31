<?php
// Initialise l’environnement Twig pour le templating

require_once __DIR__ . '/../../vendor/autoload.php';

// Définit le dossier où se trouvent les fichiers .twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');

// Crée l’environnement Twig avec options : cache et debug
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../../cache/twig', // Cache des templates compilés
    'debug' => true,                          // Mode debug (désactiver en production)
]);

// Ajout de l’extension debug (dump dans Twig)
$twig->addExtension(new \Twig\Extension\DebugExtension());
?>