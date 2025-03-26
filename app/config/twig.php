<?php
// app/config/twig.php

// Charger l'autoloader de Composer
require_once __DIR__ . '/../../vendor/autoload.php';

// Définir le dossier qui contient vos templates Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');

// Initialiser l'environnement Twig
$twig = new \Twig\Environment($loader, [
    // Pour le développement, vous pouvez désactiver le cache :
    'cache' => __DIR__ . '/../../cache/twig', // Veillez à créer le dossier "cache/twig" ou mettez 'cache' => false
    'debug' => true,
]);

// Ajouter l'extension debug pour faciliter le développement (optionnel)
$twig->addExtension(new \Twig\Extension\DebugExtension());
