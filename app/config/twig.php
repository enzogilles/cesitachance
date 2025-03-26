<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../view'); // Chemin vers tes vues
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../../cache/twig', // Activer le cache en production
    'debug' => true // Désactiver en production
]);

return $twig;
